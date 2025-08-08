<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<table>
    <thead>
    <tr>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.id')}}</th>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.name')}}</th>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.email')}}</th>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.role')}}</th>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.branch')}}</th>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.created_at')}}</th>

    </tr>
    </thead>
    <tbody>
    @foreach($admins as $admin)

        <tr>
           <td style="text-align: center; font-family: 'Segoe UI Semilight';"><a href="javascript: void(0);" class="text-body fw-bold">{{$admin->id}}</a></td>

           <td style="text-align: center; font-family: 'Segoe UI Semilight';">{{$admin->name}}</td>
           <td style="text-align: center; font-family: 'Segoe UI Semilight';">{{$admin->email}}</td>
           <td style="text-align: center; font-family: 'Segoe UI Semilight';">{{$admin->getRoleNames()[0]}}</td>

           <td style="text-align: center; font-family: 'Segoe UI Semilight';">
                {{Carbon\Carbon::parse($admin->created_at)->locale('ar')->translatedFormat('l dS F G:i - Y')}}
            </td>
            <td style="text-align: center; font-family: 'Segoe UI Semilight';">
                {{$admin->branch?$admin->branch->name:__('admin.no_exist')}}
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
</html>
