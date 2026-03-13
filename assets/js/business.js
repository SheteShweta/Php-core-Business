$(document).ready(function(){

    // Reset form when Add button clicked
    window.resetForm = function(){

        $("#businessForm")[0].reset();
        $("#id").val("");

    }


    // Populate Edit Modal
    window.editBusiness = function(id,name,address,phone,email){

        $("#id").val(id);
        $("#name").val(name);
        $("#address").val(address);
        $("#phone").val(phone);
        $("#email").val(email);

        $("#businessModal").modal("show");

    }


    // Add / Update Business
    window.addEditBusiness = function(){

        let formData = $("#businessForm").serialize();

        $.ajax({

            url: "index.php?action=addEditBusiness",
            type: "POST",
            data: formData,

            success: function(response){
                console.log(response);

                let data = JSON.parse(response);

                if(data.status === "inserted"){
                    alert("Business added successfully");
                }

                if(data.status === "updated"){
                    alert("Business updated successfully");
                }

                $("#businessModal").modal("hide");

                location.reload();

            },

            error:function(){
                alert("Something went wrong");
            }

        });

    }


    // Delete Business
    window.deleteBusiness = function(id){

        if(!confirm("Are you sure you want to delete this business?")){
            return;
        }

        $.ajax({

            url:"index.php?action=deleteBusiness",
            type:"POST",
            data:{id:id},

            success:function(response){

                let data = JSON.parse(response);

                if(data.status === "deleted"){
                    alert("Business deleted successfully");
                }

                location.reload();

            },

            error:function(){
                alert("Delete failed");
            }

        });

    }

});

// Rating Modal

document.addEventListener("DOMContentLoaded", function(){

    // ==============================
    // Show Average Rating in Table
    // ==============================

    document.querySelectorAll('.business-rating').forEach(function(el){

        const raty = new Raty(el, {

            score: el.dataset.score,

            readOnly: false,

            half: false,

            path: 'assets/images',

            click: function(score){
    
                let businessId = el.dataset.id;
    
                openRatingModal(businessId);
    
            }

        });

        raty.init();

    });

});


// ==============================
// Open Rating Modal
// ==============================

let ratingInstance;

function openRatingModal(businessId){

    $("#business_id").val(businessId);

    $("#ratingModal").modal("show");

    const el = document.querySelector("#ratingStar");

    if(!el) return;

    el.innerHTML = "";   // reset stars

    ratingInstance = new Raty(el, {

        half: true,

        score: 0,

        path: 'assets/images',

        click: function(score){

            document.getElementById("rating").value = score;

        }

    });

    ratingInstance.init();

}


// ==============================
// Submit Rating (AJAX)
// ==============================

function submitRating(){

    let formData = $("#ratingForm").serialize();

    $.ajax({

        url: "index.php?action=saveRating",

        type: "POST",

        data: formData,

        success: function(response){

            let data = JSON.parse(response);

            updateAverageRating(data.business_id, data.avg_rating);

            $("#ratingModal").modal("hide");

        },

        error:function(){

            alert("Something went wrong");

        }

    });

}


// ==============================
// Update Rating in Table
// ==============================

function updateAverageRating(businessId, avgRating){

    const el = document.querySelector('.business-rating[data-id="'+businessId+'"]');

    if(!el) return;

    el.innerHTML = "";

    const raty = new Raty(el, {

        score: avgRating,

        readOnly: false,

        half: false,

        path: 'assets/images',

        click: function(score){
            let businessId = el.dataset.id;
            openRatingModal(businessId);
        }

    });

    raty.init();

    const numEl = document.querySelector('.avg-rating-value[data-id="'+businessId+'"]');
    if (numEl) numEl.textContent = avgRating;

}