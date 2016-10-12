<!-- start: content -->
<div id="content">
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-6 col-sm-12">
                <h3 class="animated fadeInLeft">HeatMe</h3>
                <p class="animated fadeInDown"><span class="fa  fa-map-marker"></span> La Roche-Sur-Yon, Vendée</p>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="col-md-6 col-sm-6 text-right" style="padding-left:10px;">
                    <h3 style="color:#DDDDDE;"><span class="fa fa-map-marker"></span> <?= $w->getTown(); ?></h3>
                    <h1 style="margin-top: -10px;color: #ddd;"><?= $w->getTemp(); ?><sup>o</sup></h1>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="wheather">
                        <img src="<?= $w->getPic(); ?>"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12" style="padding:20px;">
        <div class="col-md-12 padding-0">
            <div class="col-md-8 padding-0">
                <div class="col-md-12 padding-0">
                    <div class="col-md-6">
                        <div class="panel box-v1">
                            <div class="panel-heading bg-white border-none">
                                <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                    <h4 class="text-left">Vos radiateurs</h4>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                    <h4>
                                        <span class="fa fa-fire icons icon text-right"></span>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel-body text-center">
                                <h1><?= $dash->getRadiatorsNumber(); ?></h1>
                                <p>Radiateurs Atlantic</p>
                                <hr/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel box-v1">
                            <div class="panel-heading bg-white border-none">
                                <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                    <h4 class="text-left">Orders</h4>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                    <h4>
                                        <span class="icon-basket-loaded icons icon text-right"></span>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel-body text-center">
                                <h1></h1>
                                <p>New Orders</p>
                                <hr/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-heading bg-white border-none">
                            <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                <h4 class="text-left">Puissance de vos radiateurs</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <h4>
                                    <span class="fa fa-bolt text-right"></span>
                                </h4>
                            </div>
                        </div>
                        <div class="panel-body text-center" style="padding-bottom:50px;">
                            <canvas class="polar-chart"></canvas>
                            <h5><?php echo \Hackathyon\Stats::getAdvice1(); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel box-v4">
                        <div class="panel-heading bg-white border-none">
                            <h4><span class="fa fa-clock-o"></span> Prévisions</h4>
                        </div>
                        <div class="panel-body padding-0">
                            <div class="col-md-12 col-xs-12 col-md-12 padding-0 box-v4-alert">
                                <h2>Prévision par météo !</h2>
                                <p>A partir de la météo nous prévoyons le fonctionnement de vos radiateurs.</p>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Heure d'action</th>
                                        <th>Etat global des radiateurs</th>
                                        <th>Température prévue</th>
                                        <th>Météo prévue</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?= $w->showPrevent(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-md-12 padding-0">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="asset/img/bg2.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="asset/img/avatar.jpg" class="img-responsive"/>
                                <h4><?= $dash->getMail(); ?></h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12 padding-0 text-center">
                                <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                    <h3><?= $dash->consumption(); ?></h3>
                                    <p>Kwh consommés</p>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                    <h3></h3>
                                    <p>share</p>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12 padding-0">
                                    <h3>4.320</h3>
                                    <p>photos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 padding-0">
                    <div class="panel box-v3">
                        <div class="panel-heading bg-white border-none">
                            <h4>Report</h4>
                        </div>
                        <div class="panel-body">

                            <div class="media">
                                <div class="media-left">
                                    <span class="icon-folder icons" style="font-size:2em;"></span>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading">Document Handling</h5>
                                    <div class="progress progress-mini">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="10"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
                                            <span class="sr-only">60% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="media">
                                <div class="media-left">
                                    <span class="icon-pie-chart icons" style="font-size:2em;"></span>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading">UI/UX Development</h5>
                                    <div class="progress progress-mini">
                                        <div class="progress-bar progress-bar-success" role="progressbar"
                                             aria-valuenow="19" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 19%;">
                                            <span class="sr-only">60% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="media">
                                <div class="media-left">
                                    <span class="icon-energy icons" style="font-size:2em;"></span>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading">Server Optimation</h5>
                                    <div class="progress progress-mini">
                                        <div class="progress-bar progress-bar-info" role="progressbar"
                                             aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 55%;">
                                            <span class="sr-only">60% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="media">
                                <div class="media-left">
                                    <span class="icon-user icons" style="font-size:2em;"></span>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading">User Status</h5>
                                    <div class="progress progress-mini">
                                        <div class="progress-bar progress-bar-warning" role="progressbar"
                                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"
                                             style="width:20%;">
                                            <span class="sr-only">60% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="media">
                                <div class="media-left">
                                    <span class="icon-fire icons" style="font-size:2em;"></span>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading">Firewall Status</h5>
                                    <div class="progress progress-mini">
                                        <div class="progress-bar progress-bar-danger" role="progressbar"
                                             aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 90%;">
                                            <span class="sr-only">60% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



<!-- start: Javascript -->
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/jquery.ui.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>


<!-- plugins -->
<script src="asset/js/plugins/moment.min.js"></script>
<script src="asset/js/plugins/fullcalendar.min.js"></script>
<script src="asset/js/plugins/jquery.nicescroll.js"></script>
<script src="asset/js/plugins/jquery.vmap.min.js"></script>
<script src="asset/js/plugins/maps/jquery.vmap.world.js"></script>
<script src="asset/js/plugins/jquery.vmap.sampledata.js"></script>
<script src="asset/js/plugins/chart.min.js"></script>


<!-- custom -->
<script src="asset/js/main.js"></script>
<script type="text/javascript">
    (function(jQuery){
        var doughnutData = [
            <?php echo \Hackathyon\Stats::roomGraph(); ?>
        ];

        window.onload = function(){

            var ctx6 = $(".polar-chart")[0].getContext("2d");
            window.myPolar = new Chart(ctx6).PolarArea(doughnutData, {
                responsive : true,
                showTooltips: true
            });
        };
    })(jQuery);
</script>
<!-- end: Javascript -->
</body>
</html>