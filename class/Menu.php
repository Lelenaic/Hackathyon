<?php

namespace Hackathyon;
use RedBeanPHP\R;

class Menu {

    public function getMenu($page) {
        $perms = R::find('perms','user_id=? and type=\'menu\'',[$_SESSION['id']]);
        $ids = array();
        foreach ($perms as $id) {
            $ids[] = $id->getProperties()['other_id'];
        }
        if ($_SESSION['admin']) {
            $menu = R::find('menu','sub is null order by num');
        } else {
            $menu = R::find('menu','id in (' . R::genSlots($ids) . ') and sub is null order by num',$ids);
        }

        foreach ($menu as $ligne) {
            if ($_SESSION['admin']) {
                $subs = R::find('menu','sub=?',[$ligne->getProperties()['id']]);
            } else {
                $subs = R::find('menu','sub=? and id in ('.R::genSlots($ids).')', array_unshift($ids,$ligne->getProperties()['id']));
            }
            if (count($subs)!=0) {
                echo '<li>
                    <a href="javascript:;" >
                        <i class="toggle-accordion"></i>
                        <i class="fa fa-' . $ligne->getProperties()['icon'] . '"></i>
                        <span>' . $ligne->getProperties()['name'] . '</span>
                    </a>
                    <ul class="sub-menu">';
                foreach ($subs as $sub) {
                    $active = $sub->getProperties()['page'] == $page ? 'class="active" ' : '';
                    echo '<li><a ' . $active . 'href="' . $sub->getProperties()['link'] . '">' . $sub->getProperties()['name'] . '</a></li>';
                }
                echo '</ul>
                        </li>';
            } else {
                $active = $ligne->getProperties()['page'] == $page ? 'class="active" ' : '';
                echo '<li>
                    <a ' . $active . 'href="' . $ligne->getProperties()['link'] . '">
                        <i class="fa fa-' . $ligne->getProperties()['icon'] . '"></i>
                        <span>' . $ligne->getProperties()['name'] . '</span>
                    </a>
                </li>';
            }
        }
    }

}
