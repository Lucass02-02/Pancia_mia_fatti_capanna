<?php

require_once __DIR__ . '/../Entity/EUserReview.php';
use AppORM\Entity\EUserReview;
require_once __DIR__ . '/FEntityManager.php';
use AppORM\Services\Foundation\FEntityManager;

class FUserReview {

    public static function getUserReviewById($id) {
        $results = FEntityManager::getInstance()->retriveObject(EUserReview::getEntity(), $id);
        return $results;
    }

    public static function getUserReviewByClient($user) {
        $results = FEntityManager::getInstance()->retriveObjectOnAttribute(EUserReview::getEntity(), 'user', $user);
        return $results;
    }

    public static function getUserReviewListByClient($user) {
        $results = FEntityManager::getInstance()->retriveObjectList(EUserReview::getEntity(), 'user', $user);
        return $results;
    }

    public static function getUserReviewListByVote($vote) {
        $results = FEntityManager::getInstance()->retriveObjectList(EUserReview::getEntity(), 'vote', $vote);
        return $results;
    }

}