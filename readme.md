## Task Manager API
This is an example laravel project. A task manager that allows you to create, edit
and delete tasks through a REST API.

## Setup
After cloning the repository, configure your database connection in the .env file.

Then run:
```
php artisan migrate:install
```
Now the database should be all set. To begin using the API, you will need to add a task owner.
```php
//[id] is most likely gonna be your users id, but could be anything
//[api_key] is most likely gonna be the api key you generated for the user
php artisan add:owner [id] [api_key]
```

After adding the owner, you can now start making http requests (refer to the API docs).

##API docs
_**Every request must include the X-Authorization header with the api key.**_

###-Show Task-

  Returns json data about a single task.

* **URL**

  /api/tasks/:id

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 
   `id=[integer]`

* **Data Params**

  None
  
* **Sample Request:**
  
    ```
      GET /api/tasks/10 HTTP/1.1
      Host: localhost
      X-Authorization: A1gH64D1h3C94
      Cache-Control: no-cache
    ```

* **Success Response:**

  * **Code:** 200 <br />
    **Sample Content:** 
    ```
    {
        "data": {
            "id": 10,
            "owner_id": 1,
            "title": "Finish paperwork",
            "description": "",
            "due_date": "2018-07-27 12:20:00",
            "completed_date": null,
            "deleted_at": null,
            "created_at": "2018-07-25 16:30:52",
            "updated_at": "2018-07-25 16:30:52"
        }
    }
    ```
 
* **Error Response:**

  * **Code:** 404 NOT FOUND <br />

  * **Code:** 403 FORBBIDEN <br />
    **Content:** `{"error":"Authentication failed. Make sure your API key is valid."}`


###-Create Task-

  Returns json data about the newly created task or an error message.

* **URL**

  /api/tasks

* **Method:**

  `POST`
  
*  **Data Params**

   **Required:**
 
   `title=[string]`
   
   **Optional:**
   
   ```
   description=[string]
   due_date=[date]
   completed_date=[date]
   ```
  
* **Sample Request:**
  
    ```
      POST /api/tasks HTTP/1.1
      Host: localhost
      X-Authorization: A1gH64D1h3C94
      Content-Type: application/x-www-form-urlencoded
      Cache-Control: no-cache
    ```

* **Success Response:**

  * **Code:** 201 <br />
    **Sample Content:** 
    ```
    {
        "data": {
            "owner_id": 6,
            "title": "Jogging",
            "description": "Going jogging every friday from this new year!",
            "due_date": null,
            "completed_date": null,
            "updated_at": "2018-07-25 19:51:42",
            "created_at": "2018-07-25 19:51:42",
            "id": 19
        }
    }
    ```
 
* **Error Response:**

    * **Code:** 403 FORBBIDEN <br />
  **Content:** `{"error":"Authentication failed. Make sure your API key is valid."}`

    * **Code:** 400 BAD REQUEST <br />
    **Content:** `{{
                       "Invalid request": {
                           "title": [
                               "The title field is required."
                           ]
                       }
                   }`


###-Update Task-

  Returns json data about the updated task or an error message.

* **URL**

  /api/tasks/:id

* **Method:**

  `PUT/PATCH`
  
*  **Data Params**
   
   **Optional:**
   
   ```
   title=[string]
   description=[string]
   due_date=[date]
   completed_date=[date]
   ```
  
* **Sample Request:**
  
    ```
      PUT /api/tasks/18 HTTP/1.1
      Host: localhost
      X-Authorization: A1gH64D1h3C94
      Content-Type: application/x-www-form-urlencoded
      Cache-Control: no-cache
    ```

* **Success Response:**

  * **Code:** 200 <br />
    **Sample Content:** 
    ```
    {
        "data": {
            "owner_id": 6,
            "title": "Jogging",
            "description": "Going jogging every friday from this new year!",
            "due_date": null,
            "completed_date": null,
            "updated_at": "2018-07-25 19:51:42",
            "created_at": "2018-07-25 19:51:42",
            "id": 19
        }
    }
    ```
 
* **Error Response:**

    * **Code:** 403 FORBBIDEN <br />
  **Content:** `{"error":"Authentication failed. Make sure your API key is valid."}`

    * **Code:** 400 BAD REQUEST <br />
    **Sample Content:** `{
                      "bad request": {
                          "due_date": [
                              "The due date is not a valid date."
                          ]
                      }
                  }


###-Delete Task-

  Returns empty response or an error message.

* **URL**

  /api/tasks/:id

* **Method:**

  `DELETE`
  
*  **URL Params**

    `id=[integer]`
  
* **Sample Request:**
  
    ```
      DELETE /api/tasks/18 HTTP/1.1
      Host: localhost
      X-Authorization: A1gH64D1h3C94
      Content-Type: application/x-www-form-urlencoded
      Cache-Control: no-cache
    ```

* **Success Response:**

  * **Code:** 204 No Content <br />

 
* **Error Response:**

    * **Code:** 403 FORBBIDEN <br />
  **Content:** `{"error":"Authentication failed. Make sure your API key is valid."}`

  * **Code:** 404 Not Found <br />

###-Show All Tasks-

  Returns json data about all tasks

* **URL**

  /api/tasks

* **Method:**

  `GET`
  
*  **URL Params**

    None

* **Data Params**

  None
  
* **Sample Request:**
  
    ```
      GET /api/tasks HTTP/1.1
      Host: localhost
      X-Authorization: A1gH64D1h3C94
      Cache-Control: no-cache
    ```

* **Success Response:**

  * **Code:** 200 OK<br />
    **Sample Content:** 
    ```
    {
        "data": [
            {
                "id": 2,
                "owner_id": 2,
                "title": "Buy eggs",
                "description": "",
                "due_date": null,
                "completed_date": null,
                "deleted_at": null,
                "created_at": "2018-07-25 16:00:26",
                "updated_at": "2018-07-25 16:00:26"
            },
            {
                "id": 3,
                "owner_id": 2,
                "title": "Call mom",
                "description": "",
                "due_date": null,
                "completed_date": null,
                "deleted_at": null,
                "created_at": "2018-07-25 16:00:29",
                "updated_at": "2018-07-25 16:00:29"
            }
        ]
    }    
    ```
 
* **Error Response:**

  * **Code:** 403 FORBBIDEN <br />
    **Content:** `{"error":"Authentication failed. Make sure your API key is valid."}`


## License

This is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
