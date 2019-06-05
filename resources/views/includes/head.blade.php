<meta charset="utf-8">
<meta name="description" content="">
<!-- load bootstrap from a cdn -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/twitter-bootstrap/3.0.3/css/bootstrap-combined.min.css">

<style>
    * {
        box-sizing: border-box;
    }

    /* Create two equal columns that floats next to each other */
    .column {
        float: left;
        padding: 10px;
        height: 300px; /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    table, th, td {
        border: 1px solid black;
        text-align: left;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th {
        height: 50px;
    }

</style>