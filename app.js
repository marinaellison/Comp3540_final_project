const message = document.getElementById( "message" );
document 
.getElementById( "registerForm")
.addEventListener( "submit", async function(e)
{
    e.preventDefault();
    const data =    new FormData(this);
    let result =   await fetch(
    "register.php",
    {
        method:"POST",
        body:data
    }
    );
    let text =  await result.text();
    message.innerHTML =  text;
} ); 
document
.getElementById("loginForm")
.addEventListener( "submit", async function(e)
{
     e.preventDefault();
    const data =  new FormData(this);
    let result =   await fetch(
    "login.php", 
       {
        method:"POST",  body:data
    }
    );
    let text =  await result.text();
    console.log(JSON.stringify(text));
    if(text === "SUCCESS")
    {
        location.href =  "dashboard.php";
    }
    else
    {
        message.innerHTML =  "Invalid Login"; } } );