// widgetNameIntr - уникальное имя вашего виджета, должно коррелировать с его назначением

widgetChangeColorLess777 = function() {
    var widget = this;
    this.code = null;

    this.yourVar = {};
    this.yourFunc = function() {};

    // вызывается один раз при инициализации виджета, в этой функции мы вешаем события на $(document)
    this.bind_actions = function(){
        //пример $(document).on('click', 'selector', function(){});
    };

    // вызывается каждый раз при переходе на страницу
    this.render = function() {
        $(document).ready(function() {
            var x = $("#status_id_15175270").children("span").css("background-color");
            var y = $("#status_id_15175270 .pipeline_status__head_title span").css("color", x);
        });
    };

    // вызывается один раз при инициализации виджета, в этой функции мы загружаем нужные данные, стили и.т.п
    this.init = function(){
        
    };

    // метод загрузчик, не изменяется
    this.bootstrap = function(code) {
        widget.code = code;
        // если frontend_status не задан, то считаем что виджет выключен
        // var status = yadroFunctions.getSettings(code).frontend_status;
        var status = 1;

        if (status) {
            widget.init();
            widget.render();
            widget.bind_actions();
            $(document).on('widgets:load', function () {
                widget.render();
            });
        }
    }
};
// создание экземпляра виджета и регистрация в системных переменных Yadra
// widget-name - ИД и widgetNameIntr - уникальные названия виджета
yadroWidget.widgets['widget-name'] = new widgetChangeColorLess777();
yadroWidget.widgets['widget-name'].bootstrap('widget-name');
