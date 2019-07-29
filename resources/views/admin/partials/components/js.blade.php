<!-- Jquery move into css.blade for starting JavaScript -->
{{-- Html::script('public/js/jquery-3.4.0.min.js') --}}

{{-- Html::script('public/plugin/select2-4.0.6-rc.1/dist/js/select2.full.min.js') --}}

{{-- Html::script('public/plugin/fontawesome-free-5.8.1-web/js/all.min.js') --}}

{{-- Html::script('public/plugin/bootstrap-4.3.1/dist/js/bootstrap.min.js') --}}
{{-- Html::script('public/plugin/Semantic-UI-CSS-master/semantic.min.js') --}}

{{ Html::script('public/plugin/lightbox/dist/js/lightbox.min.js') }}

{{ Html::script('public/js/jquery.dataTables.min.js') }}
{{ Html::script('public/plugin/DataTables-Bootstrap4/js/dataTables.bootstrap4.min.js') }}

{{-- Html::script('public/plugin/jquery-validation/jquery.validate.min.js') --}}
{{-- Html::script('public/plugin/jquery-validation/additional-methods.min.js') --}}

{{ Html::script('public/plugin/toastr/build/toastr.min.js') }}

{{ Html::script('public/plugin/mui-trade-template/global/vendor/babel-external-helpers/babel-external-helpers.js') }}
{{-- Html::script('public/plugin/mui-trade-template/global/vendor/jquery/jquery.js') --}}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/popper-js/umd/popper.min.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/bootstrap/bootstrap.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/bootstrap-datepicker/bootstrap-datepicker.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/animsition/animsition.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/mousewheel/jquery.mousewheel.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/asscrollbar/jquery-asScrollbar.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/asscrollable/jquery-asScrollable.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/waves/waves.js') }}

<!-- Plugins -->
{{ Html::script('public/plugin/mui-trade-template/global/vendor/jquery-mmenu/jquery.mmenu.min.all.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/switchery/switchery.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/intro-js/intro.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/screenfull/screenfull.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/slidepanel/jquery-slidePanel.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/chartist/chartist.min.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/jvectormap/jquery-jvectormap.min.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/jvectormap/maps/jquery-jvectormap-world-mill-en.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/matchheight/jquery.matchHeight-min.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/vendor/peity/jquery.peity.min.js') }}

<!-- Scripts -->
{{ Html::script('public/plugin/mui-trade-template/global/js/Component.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/js/Plugin.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/js/Base.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/js/Config.js') }}

{{ Html::script('public/plugin/mui-trade-template/mmenu/assets/js/Section/Menubar.js') }}
{{ Html::script('public/plugin/mui-trade-template/mmenu/assets/js/Section/Sidebar.js') }}
{{ Html::script('public/plugin/mui-trade-template/mmenu/assets/js/Section/PageAside.js') }}
{{ Html::script('public/plugin/mui-trade-template/mmenu/assets/js/Section/GridMenu.js') }}

<!-- Config -->
{{ Html::script('public/plugin/mui-trade-template/global/js/config/colors.js') }}
{{ Html::script('public/plugin/mui-trade-template/mmenu/assets/js/config/tour.js') }}
<!-- <script>Config.set('assets', '../assets');</script> -->

<!-- Page -->
{{ Html::script('public/plugin/mui-trade-template/mmenu/assets/js/Site.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/js/Plugin/asscrollable.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/js/Plugin/slidepanel.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/js/Plugin/switchery.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/js/Plugin/matchheight.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/js/Plugin/jvectormap.js') }}
{{ Html::script('public/plugin/mui-trade-template/global/js/Plugin/peity.js') }}

{{ Html::script('public/plugin/mui-trade-template/mmenu/assets/examples/js/dashboard/v1.js') }}

@yield('scripts')

<script type="text/javascript">
	$('#datatable').DataTable();
</script>