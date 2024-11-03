<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project Created</title>
    <meta http-equiv="Content-Type" content="text/html;">
    <meta charset="UTF-8">
    <style media="all">
    * {
        margin: 0;
        padding: 0;
        line-height: 1.3;
        font-family: 'Roboto';
        color: #333542;
    }

    body {
        font-size: .875rem;
    }

    .gry-color *,
    .gry-color {
        color: #878f9c;
    }

    table {
        width: 100%;
    }

    table th {
        font-weight: normal;
    }

    table.padding th {
        padding: .5rem .7rem;
    }

    table.padding td {
        padding: .7rem;
    }

    table.sm-padding td {
        padding: .2rem .7rem;
    }

    .border-bottom td,
    .border-bottom th {
        border-bottom: 1px solid #eceff4;
    }

    .text-left {
        text-align: left;
    }

    .text-right {
        text-align: right;
    }

    .small {
        font-size: .85rem;
    }

    .currency {}
    </style>
</head>

<body>
    <div class="email-wraper">
        <ul>
            <li><strong>Project Name : </strong> {{$project->name}}</li>
            <li><strong>Assign To : </strong> {{$project->user->name}}</li>
            <li><strong>Status : </strong> <span style="padding:5px;color:#000;background:{{$project->status->color()}}">{{$project->status->getLabel()}}</span></li>
            <li><strong>Description : </strong> {{$project->description}}</li>
        </ul>
    </div>
</body>

</html>