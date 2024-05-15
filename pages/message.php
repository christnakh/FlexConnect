<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat Application</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f2f2f2; font-family: "Rubik",sans-serif;}
        .chat-container { margin-top: 20px; }
        .chat-list { height: 80vh; overflow-y: auto; background-color: #fff; border-right: 1px solid #ccc; }
        .chat-message { height: 80vh; overflow-y: auto; background-color: #fff; }
        .chat-box { background-color: #f8f8f8; padding: 10px; }
        .user-item { cursor: pointer; padding: 10px; border-bottom: 1px solid #eee; }
        .user-item:hover, .user-item.active { background-color: #e0e0e0; }
        .message-item { padding: 5px 10px; margin: 5px; border-radius: 12px; }
        .message-item.me { background-color: #34bf49; align-self: flex-end; text-align: right; color: white; }
        .message-item.them { background-color: #3498db; align-self: flex-start; text-align: left; color: white; }
        .message-sender { font-weight: bold; font-size: small; }
        .message-text { margin-top: 2px; }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container-fluid chat-container">
        <div class="row">
            <div class="col-md-4">
                <div class="input-group mb-3">
                    <input type="text" id="searchQuery" class="form-control" placeholder="Search users...">
                    <div class="input-group-append">
                        <button id="searchBtn" class="btn btn-outline-secondary" type="button">Search</button>
                    </div>
                </div>
                <div id="userList" class="chat-list"></div>
            </div>
            <div class="col-md-8">
                <div id="messages" class="chat-message"></div>
                <div class="chat-box">
                    <input type="text" id="messageText" class="form-control" placeholder="Write a message...">
                    <button id="sendBtn" class="btn btn-success mt-2">Send</button>
                    <a id="sendBtn" class="btn btn-alert mt-2" href="/">Back Home</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        var fetchInterval;

        loadUsers("");

        $("#searchBtn").click(function() {
            var query = $("#searchQuery").val();
            loadUsers(query);
        });

        function loadUsers(query) {
            $.post("searchUsers.php", { search_query: query }, function(data) {
                var users = JSON.parse(data);
                var userList = $("#userList");
                userList.empty();
                users.forEach(function(user) {
                    userList.append(`<div class='user-item chat-btn' data-user-id='${user.UserID}'>${user.Name}</div>`);
                });
                attachChatEventHandlers();
            });
        }

        function attachChatEventHandlers() {
            $('.chat-btn').click(function() {
                $('.chat-btn').removeClass('active');
                $(this).addClass('active');
                var userId = $(this).data('user-id');
                selectUser(userId);
            });
        }

        $("#sendBtn").click(function() {
            var messageText = $("#messageText").val();
            if (!messageText.trim()) {
                alert("Cannot send an empty message.");
                return;
            }
            if (!window.currentChatUser) {
                alert("Select a user to chat with first.");
                return;
            }

            $.post("sendMessage.php", {
                receiver_id: window.currentChatUser,
                message_text: messageText
            }, function(response) {
                $("#messages").append(`<div class='message-item me'><span class='message-sender'>Me</span><div class='message-text'>${messageText}</div></div>`);
                $("#messageText").val("");
                fetchMessages(); 
            });
        });

        function selectUser(userId) {
            window.currentChatUser = userId;
            $("#messages").html('');
            if (fetchInterval) clearInterval(fetchInterval);
            fetchMessages();
            fetchInterval = setInterval(fetchMessages, 1500);
        }

        function fetchMessages() {
            if (!window.currentChatUser) return;
            $.post("fetchMessages.php", { receiver_id: window.currentChatUser }, function(data) {
                var messages = JSON.parse(data);
                var messagesDiv = $("#messages");
                messagesDiv.html('');
                messages.forEach(function(msg) {
                    var className = msg.SenderID == '<?= $_SESSION['UserID'] ?>' ? 'me' : 'them';
                    var senderName = className == 'me' ? 'Me' : msg.SenderName;
                    messagesDiv.append(`<div class='message-item ${className}'><span class='message-sender'>${senderName}</span><div class='message-text'>${msg.MessageText}</div></div>`);
                });
            });
        }
    });
    </script>
</body>
</html>
