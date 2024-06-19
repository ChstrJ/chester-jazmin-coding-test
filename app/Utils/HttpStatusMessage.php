<?php 

namespace App\Utils;

//for http status message that can be reusable
class HttpStatusMessage {
    const OK = "Success! Your request was processed.";
    const CREATED = "Congratulations! Your request led to a new resource creation.";
    const BAD_REQUEST = "Oops! Something's wrong with your request. Please check and try again.";
    const NOT_FOUND = "Sorry, the requested resource couldn't be found.";
    const UNPROCESSABLE_ENTITY = "Sorry, we couldn't process your request. Please check the data and try again.";
}