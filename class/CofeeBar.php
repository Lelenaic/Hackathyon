<?php


namespace Hackathyon;

use RedBeanPHP\R;

class CofeeBar
{
    public function getContent()
    {
        $html = '';
        for ($i = 0; $i < floor(date('H')/4); $i++) {
            $time=($i-1)<0 ? 0:($i-1);
            if ($time<10){
                $time='0'.$time.':00';
            }else{
                $time=$time.':00';
            }
            $time2=$i*4;
            if ($time2<10 and $time!='0'){
                $time2='0'.$time.':00';
            }else{
                $time2=$time2.':00';
            }
            var_dump($time,$time2);
            $data=R::find('operatingmode','timestamp between ? and ? and user_id=? ',[__DATE__.' '.$time*4,__DATE__.' '.$time2,$_SESSION['id']]);
            $isOn=$this->isOn($data);
            $state=$isOn ? 'Allumé':'Eteint';
            $html .= '<li class="mini-timeline-highlight mini-timeline-danger">
                    <div class="mini-timeline-panel">
                        <h5 class="time">'.($i*4).'h00</h5>
                        <p>'.$state.'</p>
                    </div>
                </li>';
        }
        return $html;
    }

    private function isOn($data){
        $number=0;
        foreach ($data as $item) {
            if ($item->getProperties()['mode']!='standby'){
                $number++;
            }
        }
        var_dump($number);
        if ($number>count($data)){
            return true;
        }else{
            return false;
        }
    }
}