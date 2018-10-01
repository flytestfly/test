      <ul class="sidebar-menu">
        <li class="header">ГЛАВНОЕ МЕНЮ</li>
        <li class="treeview">
          <a href="{{route('main')}}" target="_blank">
            <i class="fa fa-arrow-right"></i> <span>Сайт</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{route('main.admin')}}">
            <i class="fa fa-dashboard"></i> <span>Админ-панель</span>
          </a>
        </li>
        <li><a href="{{route('events.index')}}"><i class="fa fa-list-ul"></i> <span>Мероприятия</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green">1</small>
          </span></a>
        </li>
        <li><a href="{{route('tests.index')}}"><i class="fa fa-sticky-note-o"></i> <span>Тесты</span>
          <span class="pull-right-container">
              <small class="label pull-right bg-green">3</small>
          </span></a>
        </li>
        <li><a href="#"><i class="fa fa-commenting"></i> <span>Ответы</span>
          <span class="pull-right-container">
              <small class="label pull-right bg-green">57</small>
          </span></a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-tags"></i> <span>Статистика</span>
          </a>
        </li>
        <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> <span>Пользователи</span></a></li>
      </ul>