<div class="col-md-3">
    <div class="profile-sidebar">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
            <img src="http://keenthemes.com/preview/metronic/theme/assets/admin/pages/media/profile/profile_user.jpg"
                 class="img-responsive" alt="">
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                {{ $user->name}}
            </div>
            {{--<div class="profile-usertitle-job">--}}
            {{--Developer--}}
            {{--</div>--}}
        </div>
        <!-- END SIDEBAR USER TITLE -->
        <!-- SIDEBAR BUTTONS -->
    {{--<div class="profile-userbuttons">--}}
    {{--<button type="button" class="btn btn-success btn-sm">Follow</button>--}}
    {{--<button type="button" class="btn btn-danger btn-sm">Message</button>--}}
    {{--</div>--}}
    <!-- END SIDEBAR BUTTONS -->
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
                <li {!! classActiveSegment(3, 'show_user_adverts') !!}>
                    <a href="{{route('dashboard')}}">
                        <i class="glyphicon glyphicon-envelope"></i>
                        Новые объявления </a>
                </li>
                <li {!! classActiveSegment(3, 'show_user_adverts') !!}>
                    <a href="{{route('showUserAdverts')}}">
                        <i class="glyphicon glyphicon-file"></i>
                        Мои Объявления </a>
                </li>

                <li {!! classActiveSegment(2, 'profile') !!}>
                    <a href="{{route('userProfilePage', ['id'=>$user->id])}}">
                        <i class="glyphicon glyphicon-user"></i>
                        Профиль </a>
                </li>
                @if(Auth::user()->id == $user->id)
                    <li {!! classActiveSegment(3, 'edit') !!}>
                        <a href="{{route('editUserProfilePage')}}">
                            <i class="glyphicon glyphicon-pencil"></i>
                            Редактировать профиль </a>
                    </li>
                    <li {!! classActiveSegment(2, 'cashout') !!}>
                        <a href="{{route('addAdvert')}}">
                            <i class="glyphicon glyphicon-plus"></i>
                            Добавить объявление </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- END MENU -->
    </div>
</div>