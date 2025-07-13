<?php
namespace AppORM\Views;
class VReview {
    private $smarty;
    public function __construct() { $this->smarty = StartSmarty::configuration(); }
    public function showAllReviews(array $reviews) {
        $this->smarty->assign('reviews', $reviews);
        $this->smarty->assign('titolo', 'Tutte le Recensioni');
        $this->smarty->display('all_reviews.tpl');
    }
}