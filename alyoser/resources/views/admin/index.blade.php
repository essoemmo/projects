@extends('admin.layout.master')
    @section('content')


            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget stats-widget">
                        <div class="widget-body clearfix">
                            <div class="pull-left">
                                <h3 class="widget-title text-primary"><span class="counter" data-plugin="counterUp">{{$user}}</span></h3>
                                <small class="text-color">عدد المستخدمين</small>
                            </div>
                            <span class="pull-right big-icon watermark"><i class="fa fa-paperclip"></i></span>
                        </div>
                        <footer class="widget-footer bg-primary">
                            <span class="small-chart pull-right" data-plugin="sparkline" data-options="[4,3,5,2,1], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                        </footer>
                    </div><!-- .widget -->
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="widget stats-widget">
                        <div class="widget-body clearfix">
                            <div class="pull-left">
                                <h3 class="widget-title text-danger"><span class="counter" data-plugin="counterUp">{{$category}}</span></h3>
                                <small class="text-color">الاقسام الرئيسية</small>
                            </div>
                            <span class="pull-right big-icon watermark"><i class="fa fa-ban"></i></span>
                        </div>
                        <footer class="widget-footer bg-danger">
                            <span class="small-chart pull-right" data-plugin="sparkline" data-options="[1,2,3,5,4], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                        </footer>
                    </div><!-- .widget -->
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="widget stats-widget">
                        <div class="widget-body clearfix">
                            <div class="pull-left">
                                <h3 class="widget-title text-success"><span class="counter" data-plugin="counterUp">{{$subCat}}</span></h3>
                                <small class="text-color">الاقسام الفرعية</small>
                            </div>
                            <span class="pull-right big-icon watermark"><i class="fa fa-unlock-alt"></i></span>
                        </div>
                        <footer class="widget-footer bg-success">
                            <span class="small-chart pull-right" data-plugin="sparkline" data-options="[2,4,3,4,3], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                        </footer>
                    </div><!-- .widget -->
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="widget stats-widget">
                        <div class="widget-body clearfix">
                            <div class="pull-left">
                                <h3 class="widget-title text-warning"><span class="counter" data-plugin="counterUp">{{$file}}</span></h3>
                                <small class="text-color">الملفات</small>
                            </div>
                            <span class="pull-right big-icon watermark"><i class="fa fa-file-text-o"></i></span>
                        </div>
                        <footer class="widget-footer bg-warning">
                            <span class="small-chart pull-right" data-plugin="sparkline" data-options="[5,4,3,5,2],{ type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                        </footer>
                    </div><!-- .widget -->
                </div>
            </div><!-- .row -->



            <div class="row" style="position: relative;top: 370px">
                <div class="col-md-3 col-sm-6">
                   <h4>تصميم وبرمجة شركة <a href="https://serv5.com/">Serv5</a> </h4>
                </div>
            </div><!-- .row -->

        @endsection
