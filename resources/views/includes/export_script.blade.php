<script type="text/javascript">
    function exporter(){
        $search = $('#search').val();
        $from = $('#from-date').val() ? $('#from-date').val() : '';
        $to = $('#to-date').val() ? $('#to-date').val() : '';
        window.location.href="{{url(url()->current().'/export')}}?search="+$search+"&from="+$from+"&to="+$to;
    }
    $('#export').on('click',exporter);
</script>