window.Echo.private('message' + USER.id).listen(
    "MessageEvent",
    (e) => {
        console.log(e);
    }
)