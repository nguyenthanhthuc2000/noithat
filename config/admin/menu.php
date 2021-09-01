<?php 
	return[
		[
			'name' => 'Sản phẩm',
			'cap1' => [
				[
					'name' => 'Danh sách sản phẩm',
					'icon' => 'user',
					'route' => 'product-manager.index',
				],
				[
					'name' => 'Thương hiệu',
					'icon' => 'user',
					'route' => 'brand-manager.index',
				],
				[
					'name' => 'Danh mục cấp 1',
					'icon' => 'settings',
					'route' => 'category-manager.index',
				],
				[
					'name' => 'Danh mục cấp 2',
					'icon' => 'settings',
					'route' => 'item-manager.index',
				],
			]
		],
		[
			'name' => 'Đơn hàng',
			'cap1' => [
				[
					'name' => 'Đơn hàng',
					'icon' => 'user',
					'route' => 'order-manager.index',
				],
				[
					'name' => 'Mã giảm giá',
					'icon' => 'user',
					'route' => 'coupon-manager.index',
				],
			]
		],
		[
			'name' => 'Danh mục',
			'cap1' => [
				[
					'name' => 'Bài viết',
					'icon' => 'user',
					'cap2' =>[
						[
							'name' => 'Giới thiệu',
							'icon' => 'settings',
							'route' => 'blog-manager.intro',
						],
						[
							'name' => 'Tuyển dụng',
							'icon' => 'settings',
							'route' => 'blog-manager.list_post',
							'type' => 'recruiment',
						],
						[
							'name' => 'Chính sách',
							'icon' => 'settings',
							'route' => 'blog-manager.list_post',
							'type' => 'policy',
						],
						[
							'name' => 'Bài viết',
							'icon' => 'settings',
							'route' => 'blog-manager.list_post',
							'type' => 'blog',
						],
					]
				],
				[
					'name' => 'Hình ảnh',
					'icon' => 'user',
					'cap2' =>[
						[
							'name' => 'Logo header',
							'icon' => 'settings',
							'route' => 'photo-manager.photo',
							'type' => 'logoheader',
						],
						[
							'name' => 'Logo footer',
							'icon' => 'settings',
							'route' => 'photo-manager.photo',
							'type' => 'logofooter',
						],
						[
							'name' => 'Banner',
							'icon' => 'settings',
							'route' => 'photo-manager.photo',
							'type' => 'banner',
						],
						[
							'name' => 'Favicon',
							'icon' => 'settings',
							'route' => 'photo-manager.photo',
							'type' => 'favicon',
						],
						[
							'name' => 'Silder',
							'icon' => 'settings',
							'route' => 'photo-manager.listphoto',
							'type' => 'silder',
						],
						[
							'name' => 'Tiêu chí',
							'icon' => 'settings',
							'route' => 'photo-manager.listphoto',
							'type' => 'criteria',
						],
						[
							'name' => 'Đối tác',
							'icon' => 'settings',
							'route' => 'photo-manager.listphoto',
							'type' => 'partner',
						],
						[
							'name' => 'Album',
							'icon' => 'settings',
							'route' => 'photo-manager.listphoto',
							'type' => 'album',
						],
					]
				],
				[
					'name' => 'Seo',
					'icon' => 'user',
					'cap2' =>[
						[
							'name' => 'Danh mục sản phẩm',
							'icon' => 'settings',
							'route' => 'admin.index',
						],
						[
							'name' => 'Thương hiệu',
							'icon' => 'settings',
							'route' => 'admin.index',
						],
						[
							'name' => 'Sản phẩm',
							'icon' => 'settings',
							'route' => 'admin.index',
						],
						[
							'name' => 'Bài viết',
							'icon' => 'settings',
							'route' => 'admin.index',
						]
					]
				]
			]
		],
		[
			'name' => 'Setting',
			'cap1' => [
				[
					'name' => 'Thông tin',
					'icon' => 'user',
					'route' => 'admin.index',
				],
				[
					'name' => 'Quản lí mod',
					'icon' => 'user',
					'route' => 'user-manager.index',
				],
				[
					'name' => 'Danh sách nhóm vai trò',
					'icon' => 'user',
					'route' => 'roles-manager.index',
				],
				[
					'name' => 'Cài đặt chung',
					'icon' => 'user',
					'route' => 'setting-manager.index',
				]
			]
		]
	]
 ?>