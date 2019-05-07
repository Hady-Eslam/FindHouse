<?php

return [

	// DONE
	404 => '404.Begin',		// DONE
	
	// DONE
	'Register' => [

		'SignUP' => 'Register/SignUP.SignUP_Begin',		// DONE
		'SuccessSignUP' => 'Register/SuccessSignUP.SuccessSignUP_Begin',	// DONE
		'ConfirmUser' => 'Register/ConfirmUser.ConfirmUser_Begin',	// DONE

		'Login' => 'Register/Login.Login_Begin',	// DONE
		'ForgetPassword' => 'Register/ForgetPassword.Begin',	// DONE
		'ReSetPassword' => 'Register/ReSetPassword.Begin',	// DONE

		'LogOut' => 'Register/LogOut.Begin'		// DONE
	],

	'DO' => [

		'Find' => [

			'Homes' => 'DO/Find/Homes.Begin',

			'Mobiles' => 'DO/Find/Mobiles.Begin',		// DONE
			
			'HomeFoods' => 'DO/Find/HomeFoods.Begin',	// DONE
			
			'Cars' => 'DO/Find/Cars.Begin',
			
			'ElectricalTools' => 'DO/Find/ElectricalTools.Begin',	// DONE

			'Accessories' => 'DO/Find/Lux.Begin',	// DONE

			'Fashion' => 'DO/Find/Fashion.Begin',	// DONE
			
			'MedicalSupplies' => 'DO/Find/MedicalSupplies.Begin',	// DONE
			
			'Antiques' => 'DO/Find/Antiques.Begin'	// DONE
		],

		'Advertise' => 'DO/Advertise.Begin',	// STILL WORKING

		// DONE ALL
		'Post' => [
			
			'Homes' => [

				'<int>' => [
					'' => 'DO/Posts/Homes.Begin',
					'Message' => 'DO/PostMessage.Begin'
				]
			],

			'Mobiles' => [
				
				'<int>' => [
					'' => 'DO/Posts/Mobiles.Begin',
					'Message' => 'DO/PostMessage.Begin'
				]
			],

			'Cars' => [
				
				'<int>' => [
					'' => 'DO/Posts/Cars.Begin',
					'Message' => 'DO/PostMessage.Begin'
				]
			],

			'Elc' => [
				
				'<int>' => [
					'' => 'DO/Posts/Elc.Begin',
					'Message' => 'DO/PostMessage.Begin'
				]
			],

			'Lux' => [
				
				'<int>' => [
					'' => 'DO/Posts/Lux.Begin',
					'Message' => 'DO/PostMessage.Begin'
				]
			],

			'Fashion' => [
				
				'<int>' => [
					'' => 'DO/Posts/Fashion.Begin',
					'Message' => 'DO/PostMessage.Begin'
				]
			],

			'Eat' => [
				
				'<int>' => [
					'' => 'DO/Posts/Eat.Begin',
					'Message' => 'DO/PostMessage.Begin'
				]
			],

			'Doc' => [
				
				'<int>' => [
					'' => 'DO/Posts/Doc.Begin',
					'Message' => 'DO/PostMessage.Begin'
				]
			],

			'Ant' => [
				
				'<int>' => [
					'' => 'DO/Posts/Ant.Begin',
					'Message' => 'DO/PostMessage.Begin'
				]
			],
		],
		
		'EditPost' => [

			'Homes' => [
				'<int>' => 'DO/Find/Homes.Begin',
			],

			'Mobiles' => [
				'<int>' => 'DO/Find/Homes.Begin',
			],

			'Cars' => [
				'<int>' => 'DO/Find/Homes.Begin',
			],

			'Elc' => [
				'<int>' => 'DO/EditPosts/Elc.Begin',
			],

			'Lux' => [
				'<int>' => 'DO/Find/Homes.Begin',
			],

			'Fashion' => [
				'<int>' => 'DO/Find/Homes.Begin',
			],

			'Eat' => [
				'<int>' => 'DO/Find/Homes.Begin',
			],

			'Doc' => [
				'<int>' => 'DO/Find/Homes.Begin',
			],

			'Ant' => [
				'<int>' => 'DO/Find/Homes.Begin',
			]
		]
	],

	// DONE
	'Services' => [

		'Help' => 'Services/Help.Begin',	// DONE
		
		'Policy' => 'Services/Policy.Begin',	// DONE
		
		'ContactUS' => 'Services/ContactUS.Begin',	//DONE

		'AboutUS' => 'Services/AboutUS.Begin',		// DONE

		'RegisterNotifications' => 'Services/RegisterNotifications.Begin',	// DONE
	],

	// DONE
	'Profile' => [
		
		// DONE
		'Settings' => 'Profile/Settings.Begin',

		// DONE
		'User' => [
			'<int>' => 'Profile/User.begin'
		],

		// DONE
		'MyProfile' => [
			'' => 'Profile/MyProfile.Begin',
			'PeddingPosts' => 'Profile/PeddingPosts.Begin',
			'RejectedPosts' => 'Profile/RejectedPosts.Begin',
			'ApprovedPosts' => 'Profile/ApprovedPosts.Begin'
		],

		// DONE
		'Messages' => [
			'' => 'Profile/Messages.Begin',
			'Inbox' => 'Profile/Messages_Inbox.Begin',
			'Sent' => 'Profile/Messages_Sent.Begin'
		],

		// DONE
		'Message' => [
			'<int>' => 'Profile/Message.Begin'
		],

		// DONE
		'Notifications' => 'Profile/Notifications.Begin'
	],

	// DONE
	'Admin' => [
		
		// DONE
		'PeddingPosts' => 'Admin/PeddingPosts.Begin',

		// DONE
		'DeletePost' => [

			'Homes' => [
				'<int>' => 'Admin/DeletePosts/Homes.Begin'
			],

			'Mobiles' => [
					'<int>' => 'Admin/DeletePosts/Mobiles.Begin'
			],

			'Cars' => [
					'<int>' => 'Admin/DeletePosts/Cars.Begin'
			],

			'Elc' => [
					'<int>' => 'Admin/DeletePosts/Elc.Begin'
			],

			'Lux' => [
					'<int>' => 'Admin/DeletePosts/Lux.Begin'
			],

			'Fashion' => [
					'<int>' => 'Admin/DeletePosts/Fashion.Begin'
			],

			'Eat' => [
					'<int>' => 'Admin/DeletePosts/Eat.Begin'
			],

			'Doc' => [
					'<int>' => 'Admin/DeletePosts/Doc.Begin'
			],

			'Ant' => [
					'<int>' => 'Admin/DeletePosts/Ant.Begin'
			]
		],

		// DONE
		'ApprovePost' => [

			'Homes' => [
				'<int>' => 'Admin/ApprovePosts/Homes.Begin'
			],

			'Mobiles' => [
					'<int>' => 'Admin/ApprovePosts/Mobiles.Begin'
			],

			'Cars' => [
					'<int>' => 'Admin/ApprovePosts/Cars.Begin'
			],

			'Elc' => [
					'<int>' => 'Admin/ApprovePosts/Elc.Begin'
			],

			'Lux' => [
					'<int>' => 'Admin/ApprovePosts/Lux.Begin'
			],

			'Fashion' => [
					'<int>' => 'Admin/ApprovePosts/Fashion.Begin'
			],

			'Eat' => [
					'<int>' => 'Admin/ApprovePosts/Eat.Begin'
			],

			'Doc' => [
					'<int>' => 'Admin/ApprovePosts/Doc.Begin'
			],

			'Ant' => [
					'<int>' => 'Admin/ApprovePosts/Ant.Begin'
			]
		],

		// DONE
		'RejectPost' => [

			'Homes' => [
				'<int>' => 'Admin/RejectPosts/Homes.Begin'
			],

			'Mobiles' => [
					'<int>' => 'Admin/RejectPosts/Mobiles.Begin'
			],

			'Cars' => [
					'<int>' => 'Admin/RejectPosts/Cars.Begin'
			],

			'Elc' => [
					'<int>' => 'Admin/RejectPosts/Elc.Begin'
			],

			'Lux' => [
					'<int>' => 'Admin/RejectPosts/Lux.Begin'
			],

			'Fashion' => [
					'<int>' => 'Admin/RejectPosts/Fashion.Begin'
			],

			'Eat' => [
					'<int>' => 'Admin/RejectPosts/Eat.Begin'
			],

			'Doc' => [
					'<int>' => 'Admin/RejectPosts/Doc.Begin'
			],

			'Ant' => [
					'<int>' => 'Admin/RejectPosts/Ant.Begin'
			]
		],

		// DONE
		'DeleteAccount' => [
			'<int>' => 'Admin/DeleteAccount.Begin'
		]
	],

	'BackEnd' => [

		'CheckPage' => 'BackEnd/CheckPage.Begin',
		'DeletePost' => 'BackEnd/DeletePost.Begin',
		'DeleteMessage' => 'BackEnd/DeleteMessage.Begin',
		'ShowMorePosts' => 'BackEnd/ShowMoreFindPosts.Begin',

		'GetMorePeddingPosts' => 'BackEnd/GetMorePeddingPosts.Begin',

		/*	Find Area 	*/
		'GetMoreMobilesPosts' => 'BackEnd/Find/Mobiles.Begin',

		'GetMoreElcPosts' => 'BackEnd/Find/Elc.Begin',
		'GetMoreLuxPosts' => 'BackEnd/Find/Lux.Begin',
		'GetMoreFashionPosts' => 'BackEnd/Find/Fashion.Begin',
		'GetMoreEatPosts' => 'BackEnd/Find/Eat.Begin',
		'GetMoreDocPosts' => 'BackEnd/Find/Doc.Begin',
		'GetMoreAntPosts' => 'BackEnd/Find/Ant.Begin'
	]
];