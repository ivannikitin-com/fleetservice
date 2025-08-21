/**
 * Исправление проблемы с кнопкой "Подтвердить заказ" в WooCommerce Checkout Manager
 * Проблема: при ошибке валидации полей кнопка остается в состоянии "Uploading, please wait..."
 * 
 * Подключение: добавьте этот файл в тему сайта и подключите после основного скрипта плагина
 */

(function($) {
    'use strict';

    // Ждем загрузки DOM и jQuery
    $(document).ready(function() {
        
        // Функция для восстановления состояния кнопки
        function restorePlaceOrderButton() {
            var $placeOrder = $('#place_order');
            if ($placeOrder.length) {
                $placeOrder.html('Подтвердить заказ');
                $placeOrder.removeClass('wooccm-upload-process');
                
                // Разблокируем форму
                var $form = $('form.checkout');
                if ($form.hasClass('processing')) {
                    $form.removeClass('processing').unblock();
                }
            }
        }

        // Перехватываем AJAX запросы для загрузки файлов
        var originalAjax = $.ajax;
        $.ajax = function(options) {
            // Проверяем, что это запрос для загрузки файлов плагина
            if (options.url && options.url.indexOf('admin-ajax.php') !== -1 && 
                options.data && options.data.action === 'wooccm_checkout_attachment_upload') {
                
                // Сохраняем оригинальные обработчики
                var originalSuccess = options.success;
                var originalError = options.error;
                var originalComplete = options.complete;
                
                // Переопределяем success
                options.success = function(response) {
                    if (response && !response.success) {
                        // При ошибке восстанавливаем кнопку
                        restorePlaceOrderButton();
                        // Вызываем update_checkout для показа ошибок валидации
                        $('body').trigger('update_checkout');
                        return;
                    }
                    
                    // Вызываем оригинальный success если он есть
                    if (originalSuccess) {
                        originalSuccess.apply(this, arguments);
                    }
                };
                
                // Переопределяем error
                options.error = function(xhr, status, error) {
                    // При ошибке AJAX восстанавливаем кнопку
                    restorePlaceOrderButton();
                    // Вызываем update_checkout для показа ошибок валидации
                    $('body').trigger('update_checkout');
                    
                    // Вызываем оригинальный error если он есть
                    if (originalError) {
                        originalError.apply(this, arguments);
                    }
                };
                
                // Переопределяем complete
                options.complete = function(xhr, status) {
                    // Проверяем, что все файлы загружены успешно
                    var allUploaded = true;
                    if (window.fileList && typeof fileList === 'object') {
                        $.each(fileList, function(field_id, files) {
                            var $field = $('#' + field_id);
                            if ($field.length) {
                                var $attachmentIds = $field.find('.wooccm-file-field');
                                if (!$attachmentIds.val()) {
                                    allUploaded = false;
                                    return false; // прерываем цикл
                                }
                            }
                        });
                    }
                    
                    // Если не все файлы загружены, восстанавливаем кнопку
                    if (!allUploaded) {
                        restorePlaceOrderButton();
                    }
                    
                    // Вызываем оригинальный complete если он есть
                    if (originalComplete) {
                        originalComplete.apply(this, arguments);
                    }
                };
            }
            
            // Вызываем оригинальный $.ajax
            return originalAjax.apply(this, arguments);
        };

        // Дополнительная защита: слушаем событие update_checkout
        $(document.body).on('update_checkout', function() {
            // Небольшая задержка для корректной обработки
            setTimeout(function() {
                var $placeOrder = $('#place_order');
                if ($placeOrder.length && $placeOrder.hasClass('wooccm-upload-process')) {
                    // Если кнопка все еще в состоянии загрузки после update_checkout,
                    // восстанавливаем ее состояние
                    restorePlaceOrderButton();
                }
            }, 100);
        });

        // Дополнительная защита: слушаем ошибки валидации WooCommerce
        $(document.body).on('checkout_error', function() {
            restorePlaceOrderButton();
        });

        // Дополнительная защита: слушаем успешную отправку формы
        $(document.body).on('checkout_place_order_success', function() {
            restorePlaceOrderButton();
        });

        // Дополнительная защита: периодическая проверка состояния кнопки
        setInterval(function() {
            var $placeOrder = $('#place_order');
            if ($placeOrder.length && $placeOrder.hasClass('wooccm-upload-process')) {
                // Проверяем, не зависла ли кнопка в состоянии загрузки
                var uploadText = $placeOrder.text().trim();
                if (uploadText === 'Uploading, please wait...' || uploadText === 'Загрузка, пожалуйста, подождите...') {
                    // Если кнопка в состоянии загрузки более 10 секунд, восстанавливаем ее
                    if (!$placeOrder.data('upload-start-time')) {
                        $placeOrder.data('upload-start-time', Date.now());
                    } else {
                        var uploadTime = Date.now() - $placeOrder.data('upload-start-time');
                        if (uploadTime > 10000) { // 10 секунд
                            restorePlaceOrderButton();
                            $placeOrder.removeData('upload-start-time');
                        }
                    }
                }
            }
        }, 1000);

        // Логирование для отладки (можно отключить в продакшене)
        if (typeof console !== 'undefined' && console.log) {
            console.log('WOOCCM Checkout Fix: Плагин исправления загружен');
        }
    });

})(jQuery);
