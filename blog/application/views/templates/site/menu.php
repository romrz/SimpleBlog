<nav class="menu">
		<ul>

			<li><a href="<?= base_url() ?>">Inicio</a></li>
			<?php foreach($menu as $menuItem): ?>

			<li><a href="<?= category_url($menuItem->category_url) ?>"><?= $menuItem->category_display_name ?></a></li>

			<?php endforeach; ?>		

			<li>|</li>

			<?php if(is_admin()): ?>
			<li><a href="<?= base_url() . 'admin' ?>">Administrator</a></li>
			<li><a href="<?= base_url() . 'user/logout' ?>">Salir</a></li>
			<?php elseif(is_user()): ?>
			<li><?php echo user_name() ?></li>
			<li><a href="<?= base_url() . 'user/logout' ?>">Salir</a></li>
			<?php else: ?>
			<li><a href="<?= base_url() . 'user/login' ?>">Iniciar sesion</a></li>
			<?php endif; ?>

	</ul>	
</nav>