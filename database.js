// user 
const users = [
    'name', // string
    'email', // string
    'mobile', // string
    'password', // string
    'status', // Enum: active, inactive // string
    'profile_id', // int
]

// user profile
const profile = [
    'lastName', // string
    'country', // string
    'bio', // text
    'language', // enum: English, Arabic // string
    'image_id', // int
    'location_id', // int
]

// images
const images = [
    'name', // string
    'path', // string
]

// location
const locations = [
    'name', // string
    'latitude', // string
    'longitude', // string
]

// skills
const skills = [
    'name', // string
    'description', // string
]

// services
const services = [
    'title', // string
    'slug', // string
    'description', // text
    'price', // float
    'priceType', // Enum: Nagotiation, Fixed // string
    'currency', // Enum: AED, USD // string
    'status', // Enum: requested, accepted, completed // string
    'level',  // Enum: Entry, Intermediate, Expert // string
    'deadline', // date time
    'is_featured', // boolean
    'commission', // int
    'customer_id', // int
    'skills_id', // int
    'category_id', // int
    'subCategory_id', // int
    'image_id', // int
    'location_id', // int
]

// fees
const fees = [
    'name', // string
    'description', // text
    'amount', // float
    'currency', // enum: AED, USD
    'status', // enum: Active, Inactive
]

// category
const category = [
    'name', // string
    'slug', // string
    'description', // text
    'status', // Enum: active, inactive // string
    'image_id', // int
]

// subCategory  
const subCategory = [
    'name', // string
    'description', // text
    'image_id', // int
    'category_id', // int
]

// wishlists
const wishlists = [
    'provider_id', // int
    'service_id', // int
]

// bids
const bids = [
    'status', // Enum: pending, accepted, rejected // string
    'amount', // float
    'message', // text
    'provider_id', // int
    'service_id', // int
]

//bookings
const bookings = [
    'status', // Enum: accepted, rejected, completed  // string
    'customer_id', // int
    'provider_id', // int
    'bid_id', // int
    'service_id', // int
]

// reviews
const reviews = [
    'customer_id', // int
    'provider_id', // int
    'service_id', // int
    'comment', // text
    'rating', // int (1-5)
]


// payments
const payments = [
    'customer_id', // int
    'provider_id', // int
    'service_id', // int
    'amount', // float
    'currency', // enum: AED, USD
    'status', // Enum: pending, completed // string
    'method', // string
]


// messages
const messages = [
    'sender_id', // int
    'receiver_id', // int
    'message', // text
    'status', // Enum: unread, read // string
]

// notifications
const notifications = [
    'sender_id', // int
    'receiver_id', // int
    'message', // text
    'status', // Enum: unread, read // string
]


//========= 
//    API
//========


// method = POST
// user registration
// /api/v1/registration
const registration = {
    'name': 'name', // required, string
    'email': 'email', // required, unique, string
    'password': 'password', // required, string, min 8, max 32,
    'mobile': 'mobile', // required, unique, string
    'country': 'country', // required, string
    'account_type': 'provider', // required, [customer, provider], string
    'category_id': '1', // optional, [category_id], int
}
// response
let response = {
    "message": "User Created Successfully",
    "status": 200,
    "success": true,
    "data": {
        "name": "rahmat",
        "email": "rahmat@gmail.com",
        "mobile": "01713754417",
        "updated_at": "2024-11-07T15:45:37.000000Z",
        "created_at": "2024-11-07T15:45:37.000000Z",
        "id": 13
    }
}


// method = POST
// update user profile
// /api/v1/update-profile
const updateProfile = {
    'user_id': 'user_id', // required, int
    'lastName': 'lastName', // optional, string 
    'country': 'country', // optional, string 
    'bio': 'bio', // optional, text
    'image': 'image', // optional, image file 
    'language': 'language', // optional, [English, Arabic], string
    'locationName': 'locationName', // string
    'latitude': 'latitude', // string
    'longitude': 'longitude', // string
}
// response
response = {
    'message': 'message', // string
    'status': 'status', // 200 success, 401 unauthorized , 400 bad request, 500 internal server error
    'success': 'success', // boolean
    'error': 'error', // object if success = false
    'data': {
        'user_id': 'user_id', // int
        'profile': {
            'lastName': 'lastName', // string
            'country': 'country', // string
            'bio': 'bio', // text
            'language': 'language', // enum: English, Arabic // string
            'location': {
                'name': 'name', // string
                'latitude': 'latitude', // string
                'longitude': 'longitude', // string
            }, // object
            'image': {
                'url': 'url', // string
                'name': 'name', // string
            }, // int
        }
    }, // object
}



// method = POST
// user login
// /api/v1/login
const login = {
    'email': 'email', // required, string
    'password': 'password', // required, string
}

// response
response = {
    'message': 'message', // string
    'status': 'status', // 200 success, 401 unauthorized , 400 bad request, 500 internal server error
    'success': 'success', // boolean
    'error': 'error', // object if success = false
    'data': {
        'user_id': 'user_id', // int
        'profile_id': 'profile_id', // int
        'token': 'token', // string
        'refreshToken': 'refreshToken', // string
        'status': 'status', // Enum: active, inactive // string
        'user': {
            'name': 'name', // string
            'email': 'email', // string
            'mobile': 'mobile', // string
            'image': {
                'id': 'id', // int
                'url': 'url', // string
                'name': 'name', // string
            }, //object
        },// object
        'profile': {
            'lastName': 'lastName', // string
            'country': 'country', // string
            'bio': 'bio', // text
            'language': 'language', // enum: English, Arabic // string
            'location': {
                'name': 'name', // string
                'latitude': 'latitude', // string
                'longitude': 'longitude', // string
            }, // object
            'image': {
                'url': 'url', // string
                'name': 'name', // string
            }, //object
        }, // object
    }, // object

}

// method = POST
// update user profile
// /api/v1/forgot-password
const forgotPassword = {
    'email': 'email', // required, string
}
// response
response = {
    'message': 'message', // string
    'status': 'status', // 200 success, 401 unauthorized , 400 bad request, 500 internal server error
    'success': 'success', // boolean
    'error': 'error', // object if success = false
    'data': {
    },
}

// method = POST
// update password
// /api/v1/reset-password
const resetPassword = {
    'token': 'token', // required, string
    'email': 'email', // required, string
    'password': 'password', // required, string
    'password_confirmation': 'password_confirmation', // required, string
}

// response
response = {
    'message': 'message', // string
    'status': 'status', // 200 success, 401 unauthorized , 400 bad request, 500 internal server error
    'success': 'success', // boolean
    'error': 'error', // object if success = false
    'data': {
    },
}

// method = POST
// update password
// /api/v1/change-password
const changePassword = {
    'oldPassword': 'oldPassword', // required, string
    'password': 'password', // required, string
    'password_confirmation': 'password_confirmation', // required, string
}

// response
response = {
    'message': 'message', // string
    'status': 'status', // 200 success, 401 unauthorized , 400 bad request, 500 internal server error
    'success': 'success', // boolean
    'error': 'error', // object if success = false
    'data': {
    },
}

// method = POST
// create service
// /api/v1/create-service
const createService = {
    'name': 'name', // required, string
    'description': 'description', // required, text or html
    'images': 'files', // required, image files
    'price': 10.00, // required, float [10.00]
    'currency': 'USD', // required, [AED, USD]
    'lavel': 'entry', // optional, [Entry, Intermediate, Expert] string
    'skills_id': [1, 2, 3], // optional, [skills_id], array of int
    'category_id': 11, // required, int
    'subCategory_id': 11, // required, int
    'locationName': 'dhaka bangladesh', // required, string
    'latitude': '23.810331', // required, string
    'longitude': '90.412521', // required, string
    'customer_id': 1, // required, int
    'deadline': '2022-01-01', // required, date
    'status': 'active', // required, [active, inactive] string
}

// response
response = {
    'message': 'message', // string
    'status': 'status', // 200 success, 401 unauthorized , 400 bad request, 500 internal server error
    'success': 'success', // boolean
    'error': 'error', // object if success = false
    'data': {}
}


// method = get
// get service
// /api/v1/get-services

//parameters
let body = {
    'category_id': 11, // optional, int
    'subCategory_id': 11, // optional, int
    'skills_id': [1, 2, 3], // optional, [skills_id], array of int
    'lavel': 'entry', // optional, [Entry, Intermediate, Expert] string
    'status': 'active', // optional, [active, inactive] string
    'page': 1, // optional, int
    'limit': 10, // optional, int
    'locationName': 'dhaka bangladesh', // optional, string
    'latitude': '23.810331', // optional, string
    'longitude': '90.412521', // optional, string
    'customer_id': 1, // optional, int
    'provider_id': 1, // optional, int
}

// response
response = {
    'message': 'message', // string
    'status': 'status', // 200 success, 401 unauthorized , 400 bad request, 500 internal server error
    'success': 'success', // boolean
    'error': 'error', // object if success = false
    'data': {
        'services': [
            {
                'id': 1, // int
                'title': 'title', // string
                'description': 'description', // text or html
                'images': [
                    {
                        'url': 'url', // string
                        'name': 'name', // string
                    }
                ], // image files
                'price': 10.00, // float [10.00]
                'currency': 'USD', // [AED, USD]
                'level': 'entry', // [Entry, Intermediate, Expert] string
                'skills': [
                    {
                        'id': 1, // int
                        'name': 'name', // string
                    }
                ], // [skills], array
                'category': [
                    {
                        'id': 11, // int
                        'name': 'name', // string
                    }
                ],
                'subCategory': [
                    {
                        'id': 11, // int
                        'name': 'name', // string
                    }
                ], // int
                'locations': {
                    'name': 'dhaka bangladesh', // string
                    'latitude': '23.810331', // string
                    'longitude': '90.412521', // string
                }, // object
                'customer': {
                    'id': 1, // int
                    'name': 'name', // string
                }, // object
                'deadline': '2022-01-01', // date
                'status': 'active', // [active, inactive] string
            },
        ]
    },
    'pagination': {
        'page': 1, // int
        'limit': 10, // int
        'total': 1, // int
    }
}


// method = get
// get categories 
// /api/v1/get-categories
// parameters
// 'page': 1, // optional, int
// 'page_size': 10, // optional, int

// response
response = {
    "message": "All Categories",
    "status": 200,
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Patsy Harris Jr.",
            "slug": "exercitationem-voluptatem-quos-inventore",
            "description": "Quis explicabo qui qui omnis quo laudantium reprehenderit.",
            "status": "Active",
            "image_id": 24,
            "created_at": "2024-11-06T19:16:45.000000Z",
            "updated_at": "2024-11-06T19:16:45.000000Z",
            "image": {
                "id": 24,
                "path": "https://via.placeholder.com/640x480.png/002299?text=eum",
                "name": "Ruben Rolfson"
            }
        },
        {
            "id": 2,
            "name": "Ferne Kozey II",
            "slug": "occaecati-ipsum-saepe-ratione",
            "description": "Iusto ea officia vitae nemo esse molestiae.",
            "status": "Active",
            "image_id": 33,
            "created_at": "2024-11-06T19:16:45.000000Z",
            "updated_at": "2024-11-06T19:16:45.000000Z",
            "image": {
                "id": 33,
                "path": "https://via.placeholder.com/640x480.png/0055dd?text=non",
                "name": "Zachary Konopelski"
            }
        },
    ]
}

// method = get
// get singe category
// /api/v1/get-category/:id
// parameters
// 'id': 1, // int

// response
response = {
    "message": "Category Details",
    "status": 200,
    "success": true,
    "data": {
        "id": 1,
        "name": "Patsy Harris Jr.",
        "slug": "exercitationem-voluptatem-quos-inventore",
        "description": "Quis explicabo qui qui omnis quo laudantium reprehenderit.",
        "status": "Active",
        "image_id": 24,
        "created_at": "2024-11-06T19:16:45.000000Z",
        "updated_at": "2024-11-06T19:16:45.000000Z",
        "image": {
            "id": 24,
            "path": "https://via.placeholder.com/640x480.png/002299?text=eum",
            "name": "Ruben Rolfson"
        }
    }
}


// method = get
// get all sub categories
// /api/v1/get-sub-categories
// parameters
// 'category_id': 1, // optional, int

// response
response = {
    "message": "All SubCategories",
    "status": 200,
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Kayley Baumbach",
            "slug": "dolor-voluptas-debitis-eum-veritatis-aut",
            "description": "Quos accusantium et sint consequatur maiores maiores perspiciatis.",
            "status": "Active",
            "image_id": 37,
            "category_id": 20,
            "created_at": "2024-11-07T06:15:49.000000Z",
            "updated_at": "2024-11-07T06:15:49.000000Z",
            "image": {
                "id": 37,
                "path": "https://via.placeholder.com/640x480.png/006655?text=et",
                "name": "Arden Thiel Sr."
            }
        },
        {
            "id": 2,
            "name": "Ardella Effertz PhD",
            "slug": "voluptatem-qui-voluptas-aliquam-deleniti-veniam-cum-cumque",
            "description": "Nesciunt reiciendis et voluptatum alias.",
            "status": "Inactive",
            "image_id": 6,
            "category_id": 25,
            "created_at": "2024-11-07T06:15:49.000000Z",
            "updated_at": "2024-11-07T06:15:49.000000Z",
            "image": {
                "id": 6,
                "path": "https://via.placeholder.com/640x480.png/00ccaa?text=et",
                "name": "Mr. Laurel Prosacco IV"
            }
        },
    ]
}