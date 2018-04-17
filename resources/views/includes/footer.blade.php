<footer class="footer footer-white footer-big">
	<div class="container">

		<div class="content">
			<div class="row">

				<div class="col-md-3">
					<a href="{{route('index')}}"><h5>Единая транспортная карта</h5></a>
					<p>Оператор безналичной оплаты проезда Чувашской Республики</p>
					<ul class="links-vertical">
						<li>
							<a href="{{ route('register') }}">
								Регистрация
								<div class="ripple-container"></div></a>
						</li>
						<li>
							<a href="{{ route('login') }}">
									Личный кабинет
							<div class="ripple-container"></div>
							</a>
						</li>
					</ul>
					<div class="gallery-feed">
						<img src="/images/logo-mastercard.png" alt="MasterCard" class="img">
						<img src="/images/logo-visa.png" alt="Visa" class="img">
						<img src="/images/mir-logo.png" alt="Мир" class="img">
						<img src="/images/uniteller-logo.jpg" alt="Uniteller" class="img">
					</div>
				</div>
						<div class="col-md-2">
							<h5>Карты</h5>
							<ul class="links-vertical">
								<li>
									<a href="{{route('cards.ewallet')}}">
										Электронный кошелек
									</a>
								</li>
								<li>
									<b>
										<a href="/static_articles/etkplus-card">
											ЕТКплюс
										</a>
									</b>
								</li>
								<li>
									<b>
										<a href="/static_articles/airtags">
											Брелоки Airtag
										</a>
									</b>
								</li>
								<li>
									<a href="{{route('cards.sbercard')}}">
										Банковская транспортная карта
									</a>
								</li>
								<li>
									<a href="{{route('cards.travel_cards')}}">
										Проездные
									</a>
								</li>
							</ul>
						</div>
						<div class="col-md-2">
							<h5>Операции</h5>
							<ul class="links-vertical">
								<li>
									<a href="{{ route('sell-points') }}">
										Пункты продаж
									</a>
								</li>
								<li>
									<a href="{{ route('deposit-points') }}">
										Пункты пополнения
									</a>
								</li>
								<li>
									<a href="{{route('how-to-refill')}}">
										Как пополнить
									</a>
								</li>
								<li>
									<a href="{{route('conditions')}}">
										Условия
									</a>
								</li>
							</ul>
						</div>

						<div class="col-md-2">
							<h5>Связь с нами</h5>
							<ul class="links-vertical">
								<li>
									<a href="{{route('news')}}">
										Новости
									</a>
								</li>
								<li>
									<a href="{{route('static_articles')}}">
										Статьи
									</a>
								</li>
								<li>
									<a href="{{route('faq')}}">
										Вопросы и ответы
									</a>
								</li>
								<li>
									<a href="{{route('ask')}}">
										Задать вопрос
									</a>
								</li>
								<li>
									<a href="{{route('law')}}">
										Нормативная база
									</a>
								</li>
								<li>
									<a href="{{route('contacts')}}">
										Контакты
									</a>
								</li>
							</ul>
						</div>
						<div class="col-md-3">
							<h5>Пункты обслуживания физических лиц</h5>
							<p>
								Мини-офис СЗР <strong>г. Чебоксары, ул. Гузовского, 17</strong>
							</p>
							<p>
								Мини-офис ЮЗР <strong>г. Чебоксары, ул. Мате Залка, 11</strong>
							</p>
							<p>
								Мини-офис Центр <strong>г. Чебоксары, ул. Карла Маркса, 22</strong>
							</p>
							<p>
								Мини-офис НЮР <strong>г. Чебоксары, пр-кт Тракторостроителей, 35а</strong>
							</p>
							<p>
								Мини-офис Нчк <strong>г. Новочебоксарск, ул. Винокурова, 20</strong>
							</p>
							<p>
								Центральный офис <strong>г. Чебоксары, ул. 50 лет Октября, 17а</strong>
							</p>
							<h5>Пункт обслуживания юридических лиц</h5>
							<p>
								Центральный офис <strong>г. Чебоксары, ул. 50 лет Октября, 17а</strong>
							</p>
							<p><i class="material-icons">call</i> (8352) 36-03-30, 36-33-30</p>
							<a href="https://vk.com/etk21" target="_blank" class="btn btn-just-icon btn-simple btn-twitter">
								<i class="fa fa-vk"></i>
								<div class="ripple-container"></div>
							</a>
							<a href="https://www.youtube.com/channel/UCTs5hMPiVOPjActagePmNtg" target="_blank" class="btn btn-just-icon btn-simple btn-youtube">
								<i class="fa fa-youtube-square"></i>
								<div class="ripple-container"></div>
							</a>
						</div>

					</div>
				</div>

				<hr>

				<div class="copyright pull-center">
					Все права защищены © <script>document.write(new Date().getFullYear())</script> Единая транспортная карта
				</div>
			</div>
		</footer>