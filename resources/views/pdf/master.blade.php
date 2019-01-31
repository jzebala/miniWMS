<!DOCTYPE html>
<html lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
</head>
<body>
<style>
html
{
    margin-top: 2px;
    padding: 0;
}
body
{
    width: 100%;
    font-family: DejaVu Sans;
    font-size: 15px;
}
hr
{
    border: 0;
    height: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.3);
}
small
{
    color: #888888;
}

table
{
    width: 100%;
    border-collapse: collapse;
    margin-top: 5px;
}
th, td
{
    border-bottom: 1px solid #DDDDDD;
}
th
{
    height: 40px;
}
td
{
    padding: 15px;
}

#left
{
    float: left;
    font-size: 20px;
}

#left span
{
    font-size: 14px;
}

#right
{
    float: right;
    color: #888888;
    font-size: 12px;
    font-style: italic;
}
</style>

<!-- Content -->
@yield('content')

</body>
</html>