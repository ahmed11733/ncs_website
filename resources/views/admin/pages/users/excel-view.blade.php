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
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.username')}}</th>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.email')}}</th>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.phone')}}</th>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.platform')}}</th>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.has_overtime')}}</th>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.over_time_hour_price')}}</th>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.vacations')}}</th>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.salary')}}</th>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.working_hours')}}</th>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.branch')}}</th>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.company')}}</th>
        <th style="text-align: center;color: #333778;background:#e9edf1 ; font-size: 12px; font-weight: 800; font-family: 'Segoe UI Semilight';">{{__('admin.created_at')}}</th>

    </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td style="text-align: center; font-family: 'Segoe UI Semilight';">
                {{$user->id}}
            </td>
            <td style="text-align: center; font-family: 'Segoe UI Semilight';">
                {{$user->name}}
            </td>

            <td style="text-align: center; font-family: 'Segoe UI Semilight';">
                {{$user->username}}
            </td >

            <td style="text-align: center; font-family: 'Segoe UI Semilight';">
                {{$user->email}}
            </td>
            <td style="text-align: center; font-family: 'Segoe UI Semilight';">
                {{$user->country_code}}{{$user->phone}}
            </td>
            <td style="text-align: center; font-family: 'Segoe UI Semilight';">
                {{$user->platform}}
            </td>
            <td style="text-align: center; font-family: 'Segoe UI Semilight';">
                {{$user->has_over_time==\App\Helpers\Constant::HAS_OVER_TIME['True']?__('admin.yes'):__('admin.no')}}
            </td>
            <td style="text-align: center; font-family: 'Segoe UI Semilight';">
                {{$user->has_over_time==\App\Helpers\Constant::HAS_OVER_TIME['True']?$user->over_time_hour_price.' '.__('admin.app-currency'):__('admin.no_exist')}}
            </td>
            <td>
                {{$user->vacations}}
            </td>

            <td style="text-align: center; font-family: 'Segoe UI Semilight';">
                {{$user->salary}}
            </td>

            <td style="text-align: center; font-family: 'Segoe UI Semilight';">
                {{$user->working_hours}}
            </td>

            <td style="text-align: center; font-family: 'Segoe UI Semilight';">
                {{$user->branch?$user->branch->name:__('admin.no_exist')}}
            </td>
            <td style="text-align: center; font-family: 'Segoe UI Semilight';">
                {{$user->company?$user->company->name:__('admin.no_exist')}}
            </td>

            <td style="text-align: center; font-family: 'Segoe UI Semilight';">
                {{Carbon\Carbon::parse($user->created_at)->locale('ar')->translatedFormat('l dS F G:i - Y')}}
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
</html>
