$(document).ready(function(){
    const recipient = $('#recipient');
    const sender = $('#sender');
    let recipientCount = 0;
    const message = $('#message');
    const loadables = $('.loadable');
    const loadings = $('.loading');
    let errors = {};

    const clearErrors = () => errors = {}

    const updateErrorMessage = () => {
        //
        $('font').text('');
        for(let v in errors){
            $('#'+v).parent().find('font').text(errors[v]);
        }
    }

    const validateSender = () => {
        let senderID = sender.val();
        let isValid = true;
        if(!senderID || senderID.trim() == '') {
            errors['sender'] = 'please specify a sender ID';
            isValid = false;
        }
        return isValid;
    }

    const validateMessage = () => {
        let isValid = true;
        let messageCont = message.val();
        if(!messageCont || messageCont.trim() == "") {
            errors['message'] = 'enter a message to send';
            isValid = false;
        }
        return isValid;
    }

    const validateRecipients = () => {
        let recipients = recipient.val().split(',');
        let isValid = true;
        recipients = recipients.filter( r => r.trim() != "");
        recipientCount = recipients.length;
        
        if(recipientCount == 0) {
            errors['recipient'] = 'no reciever of message specified';
            isValid = false;
        }

        recipients.forEach(recipient => {
            //if (typeof recipient != 'number') {
            if(isNaN(parseInt(recipient))) {
                errors['recipient'] = 'one of the recipient number is invalid';
                isValid = false;
            }
        });

        $('#recipient-count').text(recipientCount);

        return isValid;
    }

    const parseMessagePage = () => {
        let messageCont = message.val();
        let pages = 1;

        validateMessage();

        let messageCount = messageCont.length;
        
        if(messageCount > 160) {
            pages+= Math.ceil((messageCount - 160) / 154);
        }
        $('#page-count').text(pages);
        return pages;
    }

    const sendSMS = () => {
        let isRecipientValid = validateRecipients();
        let isSenderValid = validateSender();
        let isMessageValid = validateMessage();
        if(!isRecipientValid || !isSenderValid || !isMessageValid) { // recipient, sender ID validation error. you can do any other thing here
            updateErrorMessage();
            return false
        }

        let pages = parseMessagePage();

        let cMessage = 'you are sending ' + pages + ' ' + ( pages == 1 ? ' page' : ' pages' ) + ' of message to ' + recipientCount + ' ' + ( recipientCount == 1 ? ' recipients' : ' recipient' );

        if(confirm(cMessage)) {
            loadables.attr('disable', true);
            loadings.show();

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });

            $.ajax({
                url: '/send',
                data: {sender: sender.val(), recipient: recipient.val(), message: message.val() },
                type:'post',
                dataType:'json',
                success: (res) => {
                    console.log(res)
                },
                error: (xhr, textStatus, errorThrown) => {
                    console.log(xhr.responseText)
                }
            })
        }

    }

    const getBalance = () => {
        $.ajax({
            url: '/balance',
            data: {sender: sender.val(), recipient: recipient.val(), message: message.val() },
            type:'post',
            dataType:'json',
            success: (res) => {
                console.log(res)
            },
            error: (xhr, textStatus, errorThrown) => {
                console.log(xhr.responseText)
            }
        })
    }

    message.keyup( () => {
        parseMessagePage();
    });

    $('#send').click( (e) => {
        e.preventDefault();
        clearErrors();
        updateErrorMessage();
        sendSMS();
    });
});