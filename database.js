//========= 
//    API
//========


// method = POST
// user registration
// /api/auth/register
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
let response =
{
    "message": "User Created Successfully",
    "status": 200,
    "success": true,
    "data": {
        "name": "sagar",
        "email": "sagar@gmail.com",
        "mobile": "01713754417",
        "updated_at": "2024-11-14T11:00:51.000000Z",
        "created_at": "2024-11-14T11:00:51.000000Z",
        "id": 4
    }
}


// method = POST
// user login
// /api/auth/login
const login = {
    'email': 'email', // required, string
    'password': 'password', // required, string
}

{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vYmVkZGluZy1hcGkudGVzdC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTczMTU4MTgwNSwiZXhwIjoxNzMxNTg1NDA1LCJuYmYiOjE3MzE1ODE4MDUsImp0aSI6IldWSEhNOFVFdVU3Nm9vWWMiLCJzdWIiOiIyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.a4ci3Ldff79vOolWrsHXiGpoaZQ50e045OEMmOsDErE"
}



// method = POST
// set location
// /api/auth/set-location
const setLocation = {
    'locationName': 'dhaka bangladesh', // required, string
    'latitude': '23.810331', // required, string
    'longitude': '90.412521', // required, string
}

// response
response =
{
    "message": "Location set successfully",
    "status": 200,
    "success": true,
    "data": {
        "id": 5,
        "last_name": null,
        "country": null,
        "bio": null,
        "language": "English",
        "image": null,
        "location": "dhaka bangladesh",
        "latitude": "23.810331",
        "longitude": "90.412521",
        "user_id": 3,
        "category_id": null,
        "created_at": "2024-11-14T13:04:44.000000Z",
        "updated_at": "2024-11-14T13:05:16.000000Z"
    }
}



// method = POST
// create service
// /api/auth/create-service
const createService = {
    'title': 'name', // required, string
    'description': 'description', // required, text or html
    'images': 'files', // required, image files multiple
    'price': 10.00, // required, float [10.00]
    'priceType': 'Negotiable', // required, [Negotiable, Fixed]
    'currency': 'USD', // required, [AED, USD]
    'level': 'entry', // required|in:Entry,Intermediate,Expert', string
    'skills_id': [1, 2, 3], // optional, [skills_id], array of int
    'category_id': 11, // required, int
    'subCategory_id': 11, // required, int
    'location_name': 'dhaka bangladesh', // required, string
    'latitude': '23.810331', // required, string
    'longitude': '90.412521', // required, string
    'deadline': '2022-01-01', // optional, date
    'status': 'active', // optional, [active, inactive] string
}


// response
response = {
    "message": "Service Created Successfully",
    "status": 200,
    "success": true,
    "data": {
        "title": "test service title",
        "slug": "test-service-title",
        "description": "service description",
        "price": "100.5",
        "priceType": "Fixed",
        "currency": "USD",
        "location": "dhaka bangladesh",
        "latitude": "23.810331",
        "longitude": "90.412521",
        "updated_at": "2024-11-14T13:18:41.000000Z",
        "created_at": "2024-11-14T13:18:41.000000Z",
        "id": 15,
        "user_id": 2,
        "category_id": 1,
        "sub_category_id": 2,
        "customer": {
            "id": 2,
            "name": "customer",
            "mobile": null,
            "email": "customer@example.com",
            "email_verified_at": "2024-11-13T20:15:08.000000Z",
            "created_at": "2024-11-13T20:15:08.000000Z",
            "updated_at": "2024-11-13T20:15:08.000000Z",
            "roles": [
                {
                    "id": 3,
                    "name": "customer",
                    "guard_name": "web",
                    "created_at": "2024-11-13T20:15:08.000000Z",
                    "updated_at": "2024-11-13T20:15:08.000000Z",
                    "pivot": {
                        "model_type": "App\\Models\\User",
                        "model_id": 2,
                        "role_id": 3
                    }
                }
            ]
        }
    }
}


// method = get
// get service
// /api/get-services

//parameters
let body = {
    'category_id': 11, // optional, int
    'subCategory_id': 11, // optional, int
    'skills_id': [1, 2, 3], // optional, [skills_id], array of int
    'level': 'entry', // optional, [Entry, Intermediate, Expert] string
    'status': 'active', // optional, [active, inactive] string
    'location': 'dhaka bangladesh', // optional, string
    'latitude': '23.810331', // optional, string
    'longitude': '90.412521', // optional, string
    'customer_id': 1, // optional, int
    'priceType': 'Negotiable', // optional, [Negotiable, Fixed] string
    'currency': 'USD', // optional, [AED, USD] string
    'featured': true, // optional, boolean
}

// response
response = {
    "message": "All Services",
    "status": 200,
    "success": true,
    "data": [
        {
            "id": 2,
            "title": "asdasdasda",
            "slug": "asdasdasda",
            "description": "<p>Laboris eu quos et e.</p>",
            "price": 525,
            "location": "R96X+237, Dhaka, Bangladesh",
            "latitude": "23.81051986994833",
            "longitude": "90.39820346971976",
            "priceType": "Negotiable",
            "currency": "USD",
            "status": "Active",
            "level": "Entry",
            "deadline": null,
            "commission": 0,
            "is_featured": 0,
            "category_id": 3,
            "sub_category_id": 21,
            "user_id": 2,
            "created_at": "2024-11-13T20:21:31.000000Z",
            "updated_at": "2024-11-13T20:21:31.000000Z",
            "images": [
                {
                    "id": 35,
                    "name": "Screenshot 2024-10-21 141557.png",
                    "path": "http://bedding-api.test/uploads/service/1731562229_Screenshot 2024-10-21 141557.png",
                    "service_id": 2,
                    "created_at": "2024-11-14T05:30:29.000000Z",
                    "updated_at": "2024-11-14T05:30:29.000000Z"
                },
                {
                    "id": 36,
                    "name": "Screenshot 2024-10-21 144616.png",
                    "path": "http://bedding-api.test/uploads/service/1731562229_Screenshot 2024-10-21 144616.png",
                    "service_id": 2,
                    "created_at": "2024-11-14T05:30:29.000000Z",
                    "updated_at": "2024-11-14T05:30:29.000000Z"
                },
                {
                    "id": 37,
                    "name": "Screenshot 2024-10-21 144623.png",
                    "path": "http://bedding-api.test/uploads/service/1731562229_Screenshot 2024-10-21 144623.png",
                    "service_id": 2,
                    "created_at": "2024-11-14T05:30:29.000000Z",
                    "updated_at": "2024-11-14T05:30:29.000000Z"
                }
            ],
            "skills": []
        },
    ]
}

