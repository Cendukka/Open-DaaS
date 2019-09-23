
{{--Script for exporting into CSV-file with specific time and data depending on properties, This file is included when needed--}}

<script type="text/javascript">
    function exporter(){
        $search = $('#search').val();
        $from = $('#from-date').val() ? $('#from-date').val() : '';
        $to = $('#to-date').val() ? $('#to-date').val() : '';
        window.location.href="{{url(url()->current().'/export')}}?search="+$search+"&from="+$from+"&to="+$to;
    }
    $('#export').on('click',exporter);
</script>
