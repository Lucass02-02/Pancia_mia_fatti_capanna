<?php
namespace AppORM\Views;

use AppORM\Entity\EWaiter;
use AppORM\Entity\ERestaurantHall;
use Doctrine\Common\Collections\Collection;

class VWaiter
{
    private $smarty;
    public function __construct() { $this->smarty = StartSmarty::configuration(); }

    public function showManagementPage(array $waiters, array $halls)
    {
        $this->smarty->assign('waiters', $waiters);
        $this->smarty->assign('halls', $halls);
        $this->smarty->display('manage_waiters.tpl');
    }

    public function showProfile(EWaiter $waiter)
    {
        $this->smarty->assign('waiter', $waiter);
        $this->smarty->display('waiter_profile.tpl');
    }

    public function showTablesView(Collection $tables, ERestaurantHall $hall)
    {
        $this->smarty->assign('tables', $tables);
        $this->smarty->assign('hall', $hall);
        $this->smarty->display('waiter_tables_view.tpl');
    }
}