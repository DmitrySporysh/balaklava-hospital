<div class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-top__logo-wpapper header-top__logo-wpapper_left logo-wrapper">
                <a href="#" class="logo-wrapper__logo"></a>
            </div>
            <div class="header-top__user-panel header-top__user-panel_right">
                <ul class="header-top__user-menu header-top__user-menu_right user-menu">
                    <li class="user-menu__item">
                        <a href="#" class="user-menu__ref">
                            <span class="user-menu__icon user-menu__icon_requirements"></span>
                            <span class="user-menu__item-title">Обязанности</span>
                        </a>

                    <li class="user-menu__item">
                        <a href="#" class="user-menu__ref">
                            <span class="user-menu__icon user-menu__icon_help"></span>
                            <span class="user-menu__item-title">Помощь</span>
                        </a>

                    <li class="user-menu__item ">
                        <a href="#" class="user-menu__ref">
                            <span class="user-menu__icon user-menu__icon_add"></span>
                            <span class="user-menu__item-title">ХХХХ</span>
                        </a>

                    <li class="user-menu__item user-menu__item_right user-info">
                        <img class="user-info__photo user-info__photo_left" src="/img/user-icons/adminav.png" alt="user-photo">
                        <div class="user-info__badge user-info__badge_right user-badge">
                            <span class="user-badge__name">{{Session::get('fio')}}</span>
                            <span class="user-badge__post">{{Session::get('post')}}</span>
                        </div>

                </ul>
                <div class="header-top__search header-top__search_right search">
                    <fieldset>
                        <input class="search__input" type="text" value="Search">
                        <i class="fa fa-search search__icon search-icon"></i>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
    <div class="nav">
        <ul class="nav__list nav__list_left nav-list">
            <li class="nav-list__item" >
                <a ui-sref="received_patients" ui-sref-active="nav-list__ref_active" class="nav-list__ref nav-list__icon nav-list__icon_patients">
                    <span class="nav-list__item-name">Поступившие</span>
                </a>

            <li class="nav-list__item">
                <a ui-sref="new_patient" ui-sref-active="nav-list__ref_active"  class="nav-list__ref nav-list__icon nav-list__icon_register">
                    <span class="nav-list__item-name">Новая регистрация</span>
                </a>

            <li class="nav-list__item">
                <a href="" class="nav-list__ref nav-list__icon nav-list__icon_news">
                    <span class="nav-list__item-name">Уведомления</span>
                </a>

            <li class="nav-list__item">
                <a href="" class="nav-list__ref nav-list__icon nav-list__icon_notes">
                    <span class="nav-list__item-name">Заметки</span>
                </a>

            <li class="nav-list__item">
                <a href="" class="nav-list__ref nav-list__icon nav-list__icon_schedule">
                    <span class="nav-list__item-name">Расписание</span>
                </a>

            <li class="nav-list__item">
                <a href="" class="nav-list__ref nav-list__icon nav-list__icon_reports">
                    <span class="nav-list__item-name">Отчеты</span>
                </a>

            <li class="nav-list__item">
                <a href="" class="nav-list__ref nav-list__icon nav-list__icon_catalog">
                    <span class="nav-list__item-name">Архив</span>
                </a>
        </ul>
    </div>
</div>