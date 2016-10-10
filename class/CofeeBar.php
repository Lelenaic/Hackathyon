<?php


namespace Hackathyon;

use RedBeanPHP\R;

class CofeeBar
{
    public function getContent()
    {
        $html = '';
        $data=R::find('');
        for ($i = 0; $i < date('H'); $i++) {
            $html .= '<li class="mini-timeline-highlight">
                    <div class="mini-timeline-panel">
                        <h5 class="time">07:00</h5>
                        <p>Coding!!</p>
                    </div>
                </li>';
        }
    }
}