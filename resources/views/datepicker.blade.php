<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
    <div class="container">
        <div class="flatpickr">
            <input type="datetime-local" placeholder="Select Date.." data-input> <!-- input is mandatory -->

            <a class="input-button" title="toggle" data-toggle>
                <i class="icon-calendar"></i>
            </a>

            <a class="input-button" title="clear" data-clear>
                <i class="icon-close"></i>
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        config = {
            altFormat: "F j, Y, w"
            , startTime: "07:00"
            , minTime: "07:00"
            , maxTime: "17:30"
            , enableTime: true
            , dateFormat: 'Y-m-d H:i'
            , minuteIncrement: 30
            , minDate: new Date()
            , "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);

                }
            ]
            , "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            }
        }
        flatpickr("input[type=datetime-local]", config);

    </script>
</body>
</html>
