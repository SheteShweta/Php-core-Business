<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "controllers/BusinessController.php";
require_once "controllers/RatingController.php";

$controller = new BusinessController();

$action = $_GET['action'] ?? 'list';

switch ($action) {

    case 'addEditBusiness':
        $controller->addEditBusiness();
        break;

    case 'deleteBusiness':
        $controller->deleteBusiness();
        break;

    case 'saveRating':
        $ratingController = new RatingController();
        $ratingController->saveRating();
    exit;

    default:
        $businesses = $controller->getBusinesses();
        require "views/business_list.php";
}