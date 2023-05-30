<?php 

class DbHelper{
    private $conn;

    function createDbConnection(){
        try{
            $this->conn = new mysqli("localhost","root","","users_db");
        }catch (Exception $error){
            echo $error->getMessage();
        
        }
            }
            function insertNewEmployee($username, $password, $email, $image) {
                try {
                    $current_date = date('Y-m-d H:i:s');
                    
                    $sql = "INSERT INTO employees (username, password, email, image, date) VALUES ('$username', '$password', '$email', '$image', '$current_date')";
                    $result =  $this->conn->query($sql);
                    if ($result == true) {
                        $this->createResponse(true,1,
                         $this->createEmployeeResponse($this->conn->insert_id,$username,$password, $email, $image, $current_date));
                 
                    } else {
                        $this->createResponse(false,0, "Data has not been inserted");
                    }
                } catch (Exception $error) {
                    $this->createResponse(false,1 ,$error->getMessage());
                }}
            



                function getAllEmployees(){
                    try{
                        $sql = "select * from employees";
                        $result = $this->conn->query($sql);
               
                        $count =  $result->num_rows;
                        if($count >0){
                            $all_employee_array = array();
                            while ($row = $result->fetch_assoc()){
                                $id = $row["id"];
                                $username = $row["username"];
                                $password = $row["password"];
                                $email = $row["email"];
                                $image = $row["image"];
                                $date = $row["date"];
                                // create associative array for the student
                                $employee_array = $this->createEmployeeResponse($id,$username,$password,$email,$image,$date);
                                array_push($all_employee_array,$employee_array);
                            }
                            $this->createResponse(true,$count,$all_employee_array);
                        }
                        else{
                        }
                    }catch (Exception $exception){
                        $this->createResponse(false,0,array("error"=>$exception->getMessage()));
                    }
               
              
                   }
                   function getEmployeesById($id){
                    $sql = "select * from employees where id = $id";
                    $result = $this->conn->query($sql);
                    try{
                        if($result->num_rows ==0){
                            throw new Exception("there are no employees with the passed id");
                        }
                        else{
                            $row =   $result->fetch_assoc();
                            $id = $row["id"];
                            $username = $row["username"];
                            $password = $row["password"];
                            $email = $row["email"];
                            $image = $row["image"];
                            $date = $row["date"];
                            // create associative array for the student
                            $employee_array = $this->createEmployeeResponse($id,$username,$password,$email,$image,$date);
                            $this->createResponse(true,1,$employee_array);
            
                        }
                    }
                    catch (Exception $exception){
                        http_response_code(400);
                        $this->createResponse(false,0,array("error"=>$exception->getMessage()));
                    }
            
                }

                function updateEmployee($id,$username,$password,$email,$image){
                    try{}
                    catch (Exception $exception){
                        $this->createResponse(false,0,array("error"=>$exception->getMessage()));
                    }}
     

            function createResponse($isSuccess,$count,$data){
                echo json_encode(array(
                    "success"=>$isSuccess,
                    "count"=>$count,
                    "data"=>$data
                ));
        }






        function createEmployeeResponse($id, $username,$password, $email, $image, $created_date) {
            return array(
                "id" => $id,
                "username" => $username,
                "password" => $password,
                "email" => $email,
                "image" => $image,
                "date" => $created_date
            );
        }
     
    

        }

























?>