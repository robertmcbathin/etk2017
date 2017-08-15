<nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                            <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"> @yield('title') </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="dashboard.html#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">dashboard</i>
                                    <p class="hidden-lg hidden-md">@yield('title')</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="dashboard.html#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">lock</i>
                                    <p class="hidden-lg hidden-md">
                                        Блок-лист
                                        <b class="caret"></b>
                                    </p>
                                    <span class="notification">{{$blocklist_count}}</span>
                                </a>
                                <ul class="dropdown-menu">
                                <li>Список карт, подлежащих блокировке/разблокировке</li>
                                @foreach ($blocklist as $block_card)
                                    <li>
                                        <a href="{{ route('sudo.block-card.cancel',['card_number' => $block_card->card_number]) }}">номер карты: <strong>{{ $block_card->card_number}}</strong> создал: {{$block_card->name}} - отменить</a>
                                    </li>
                                @endforeach
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="dashboard.html#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">account_box</i>
                                    <p class="hidden-lg hidden-md">
                                        Блок-лист (ЛК)
                                        <b class="caret"></b>
                                    </p>
                                    <span class="notification">{{$profile_blocklist_count}}</span>
                                </a>
                                <ul class="dropdown-menu">
                                <li>Список карт, подлежащих блокировке/разблокировке (личный кабинет)</li>
                                @foreach ($profile_blocklist as $profile_block_card)
                                    <li>
                                        <a href="">номер карты: <strong>{{ $profile_block_card->card_number}}</strong> создал: {{$profile_block_card->name}}</a>
                                    </li>
                                @endforeach
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="dashboard.html#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">notifications</i>
                                    <p class="hidden-lg hidden-md">
                                        Уведомления
                                        <b class="caret"></b>
                                    </p>
                                    <span class="notification">0</span>
                                <div class="ripple-container"></div></a>
                                <ul class="dropdown-menu">
                                                                </ul>
                            </li>
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
                    </div>
                </div>
            </nav>