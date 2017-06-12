<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" id="sectionsNav">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('index') }}"><img src="/images/logo.png" height="45px" alt=""></a>
		</div>

		<div class="collapse navbar-collapse" id="navigation-example">
			<ul class="nav navbar-nav navbar-right">
				<li>
				  	<h4><strong>{{ session()->get('current_card_balance', 'н/д') }}</strong> <i class="fa fa-ruble"></i> </h4> 
				</li>
				<li class="dropdown">
					<a href="#pablo" class="profile-photo dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<div class="profile-photo-small">
							<img class="img-responsive" src="{{ session()->get('current_card_image_type', '/pictures/cards/thumbnails/160/999.png') }}" width="40px">
						</div>
						<b class="caret"></b>
						<div class="ripple-container"></div></a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li class="dropdown-header">Выберите основную карту</li>
							@foreach ($cards as $card)
							<li>
								<a href="{{ route('profile.set_current_card.set', ['current_card' => $card->number, 'user_id' => Auth::user()->id]) }}" class="link-profile">
									<div class="media">
										<div class="profile-photo-small">
											<img class="img-responsive" src="/pictures/cards/thumbnails/160/{{$card->card_image_type}}.png" width="40px">
										</div>
										<div class="media-body">
											<h4 class="media-heading"><small>{{ $card->number }}</small></h4>
										</div>
									</div>
								</a>
							</li>
							@endforeach
						</ul>
					</li>
					<li class="dropdown">
						<a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="material-icons">payment</i> Пополнение
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu dropdown-with-icons">
							<li>
								<a href="{{route('profile.deposit')}}" class="link-menu">
									<i class="material-icons">account_balance_wallet</i> Пополнить счет
								</a>
							</li>
							<li>
								<a href="{{route('profile.deposit_history')}}" class="link-menu">
									<i class="material-icons">list</i> История пополнения
								</a>
							</li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="material-icons">contact_mail</i> Детализация
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu dropdown-with-icons">
							<li>
								<a href="{{route('profile.details_request')}}" class="link-menu">
									<i class="material-icons">insert_comment</i> Создать запрос
								</a>
							</li>
							<li>
								<a href="{{route('profile.details_history')}}" class="link-menu">
									<i class="material-icons">library_books</i> История запросов
								</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">

						<a href="#pablo" class="profile-photo dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<div class="profile-photo-small">
								<img src="{{ Auth::user()->profile_image }}" alt="Circle Image" class="img-rounded img-responsive">
							</div>

							<div class="ripple-container"><div class="ripple ripple-on" style="left: 23px; top: 23.7031px; background-color: rgb(255, 255, 255); transform: scale(5);"></div></div></a>
							<ul class="dropdown-menu">
								<li class="dropdown-header">
									{{ Auth::user()->name }}
								</li>
								<li>
									<a href="{{ route('profile') }}" class="link-menu">Моя страница</a>
								</li>
								<li>
									<a href="{{ route('profile.settings') }}" class="link-menu">Настройки</a>
								</li>
								<li class="divider"></li>
								<li>						<a href="{{ route('logout') }}" target="_blank" class="btn btn-danger">
									<i class="material-icons">account_box</i> Выйти
									<div class="ripple-container"></div></a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>