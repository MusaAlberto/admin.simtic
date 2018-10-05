<div class="col-md-3 left_col">
	<div class="left_col scroll-view">
		<div class="navbar nav_title" style="border: 0;">
			<a href="<?=base_url()?>" class="site_title">
				<img src="<?=base_url()?>assets/images/icon.png" width="50px" height="50px">
				<span>ANTOLOGI</span>
			</a>
		</div>
		<div class="clearfix"></div>
		<!--

		<div class="profile clearfix">
			<div class="profile_pic">
				<img src="<?=base_url()?>assets/images/img.jpg" alt="..." class="img-circle profile_img">
			</div>
			<div class="profile_info">
				<span>Welcome,</span>
				<h2>Masruh Choeroni</h2>
			</div>
		</div>
		-->

		<!-- sidebar menu -->
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			<div class="menu_section">
				<ul class="nav side-menu">
				<?php 
					$level = $this->session->userdata('level_user');
					if ($level == 'superadmin') {
						$main_menu 	= $this->db->query(
							  "SELECT * FROM menu_sidebar 
							  WHERE is_main_menu='X' AND status_menu<>'1' AND level_menu='all'
							  ORDER BY kd_menu;");
						foreach ($main_menu->result() as $menu) {
							$sub_menu 	= $this->db->query(
										  "SELECT * FROM menu_sidebar 
										  WHERE is_main_menu='$menu->kd_menu' AND status_menu<>'1' AND level_menu='all'
										  ORDER BY judul_menu");
							if ($sub_menu->num_rows()>0){
								//main_menu dengan sub_menu
								echo 	'<li>
											<a class="' . $menu->status_menu . '">
												<i class="' . $menu->icon_menu 	. '"></i>
												' . $menu->judul_menu . '
												<span class="fa fa-chevron-down"></span>
											</a>
											<ul class="nav child_menu">';
								foreach ($sub_menu->result() as $submenu) {
									echo 	'<li><a class="' . $submenu->status_menu . '"
											 href="' . base_url() . $submenu->link_menu . 
										 	'">' . $submenu->judul_menu . '</a></li>';
								}		
								echo '</ul></li>';
							} else {
								//main_menu tanpa sub_menu atau tunggal
								echo 	'<li>
											<a class="' . $menu->status_menu . '" 
												href="' . base_url() . $menu->link_menu . '">
												<i class="' . $menu->icon_menu 	. '"></i>
												' . $menu->judul_menu . '
											</a>
										</li>';
							}
						}
					}else if($level == 'admin'){
						$main_menu 	= $this->db->query(
							  "SELECT * FROM menu_sidebar 
							  WHERE is_main_menu='X' AND status_menu<>'1' AND level_menu='all'
							  ORDER BY kd_menu;");
						foreach ($main_menu->result() as $menu) {
							$sub_menu 	= $this->db->query(
										  "SELECT * FROM menu_sidebar 
										  WHERE is_main_menu='$menu->kd_menu' AND status_menu<>'1' AND level_menu='all'
										  ORDER BY judul_menu");
							if ($sub_menu->num_rows()>0){
								//main_menu dengan sub_menu
								echo 	'<li>
											<a class="' . $menu->status_menu . '">
												<i class="' . $menu->icon_menu 	. '"></i>
												' . $menu->judul_menu . '
												<span class="fa fa-chevron-down"></span>
											</a>
											<ul class="nav child_menu">';
								foreach ($sub_menu->result() as $submenu) {
									echo 	'<li><a class="' . $submenu->status_menu . '"
											 href="' . base_url() . $submenu->link_menu . 
										 	'">' . $submenu->judul_menu . '</a></li>';
								}		
								echo '</ul></li>';
							} else {
								//main_menu tanpa sub_menu atau tunggal
								echo 	'<li>
											<a class="' . $menu->status_menu . '" 
												href="' . base_url() . $menu->link_menu . '">
												<i class="' . $menu->icon_menu 	. '"></i>
												' . $menu->judul_menu . '
											</a>
										</li>';
							}
						}
						$menu_khusus = $this->db->query(
							  "SELECT * FROM menu_sidebar 
							  WHERE level_menu='admin'");
						foreach ($menu_khusus->result() as $menu) {
								//main_menu tanpa sub_menu atau tunggal
								echo 	'<li>
											<a class="' . $menu->status_menu . '" 
												href="' . base_url() . $menu->link_menu . '">
												<i class="' . $menu->icon_menu 	. '"></i>
												' . $menu->judul_menu . '
											</a>
										</li>';
							
						}
					}else if($level == 'dosen'){
						$main_menu 	= $this->db->query(
							  "SELECT * FROM menu_sidebar 
							  WHERE is_main_menu='X' AND status_menu<>'1' AND level_menu='all'
							  ORDER BY kd_menu;");
						foreach ($main_menu->result() as $menu) {
							$sub_menu 	= $this->db->query(
										  "SELECT * FROM menu_sidebar 
										  WHERE is_main_menu='$menu->kd_menu' AND status_menu<>'1'
										  ORDER BY judul_menu");
							if ($sub_menu->num_rows()>0){
								//main_menu dengan sub_menu
								echo 	'<li>
											<a class="' . $menu->status_menu . '">
												<i class="' . $menu->icon_menu 	. '"></i>
												' . $menu->judul_menu . '
												<span class="fa fa-chevron-down"></span>
											</a>
											<ul class="nav child_menu">';
								foreach ($sub_menu->result() as $submenu) {
									echo 	'<li><a class="' . $submenu->status_menu . '"
											 href="' . base_url() . $submenu->link_menu . 
										 	'">' . $submenu->judul_menu . '</a></li>';
								}		
								echo '</ul></li>';
							} else {
								//main_menu tanpa sub_menu atau tunggal
								echo 	'<li>
											<a class="' . $menu->status_menu . '" 
												href="' . base_url() . $menu->link_menu . '">
												<i class="' . $menu->icon_menu 	. '"></i>
												' . $menu->judul_menu . '
											</a>
										</li>';
							}
						}
						$menu_khusus 	= $this->db->query(
							  "SELECT * FROM menu_sidebar 
							  WHERE is_main_menu='X' AND status_menu<>'1' AND level_menu='dosen'
							  ORDER BY kd_menu;");
						foreach ($menu_khusus->result() as $menu) {
							$sub_menu 	= $this->db->query(
										  "SELECT * FROM menu_sidebar 
										  WHERE is_main_menu='$menu->kd_menu' AND status_menu<>'1' 
										  ORDER BY judul_menu");
							if ($sub_menu->num_rows()>0){
								//main_menu dengan sub_menu
								echo 	'<li>
											<a class="' . $menu->status_menu . '">
												<i class="' . $menu->icon_menu 	. '"></i>
												' . $menu->judul_menu . '
												<span class="fa fa-chevron-down"></span>
											</a>
											<ul class="nav child_menu">';
								foreach ($sub_menu->result() as $submenu) {
									echo 	'<li><a class="' . $submenu->status_menu . '"
											 href="' . base_url() . $submenu->link_menu . 
										 	'">' . $submenu->judul_menu . '</a></li>';
								}		
								echo '</ul></li>';
							} else {
								//main_menu tanpa sub_menu atau tunggal
								echo 	'<li>
											<a class="' . $menu->status_menu . '" 
												href="' . base_url() . $menu->link_menu . '">
												<i class="' . $menu->icon_menu 	. '"></i>
												' . $menu->judul_menu . '
											</a>
										</li>';
							}
						}
					}
				?>
				</ul>
			</div>
		</div>
		<!-- /sidebar menu -->

	</div>
</div>