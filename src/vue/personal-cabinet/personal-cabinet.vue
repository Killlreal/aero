<template lang="pug">
    .personal-cabinet
        .personal-cabinet-header.mt-80
            p.personal-cabinet-header__title Личный кабинет
            .personal-cabinet-header__exit
                p.personal-cabinet-header__exit-text Выход
                svg.personal-cabinet-header__exit-icon
                    use(href = "/assets/icons/icons.svg#exit-icon")
        .personal-cabinet-info
            .personal-info
                .personal-info__item
                    .personal-info__item-name ФИО
                    .personal-info__item-value Камбердвач Константин Александрович
                .personal-info__item
                    .personal-info__item-name Электронная почта
                    .personal-info__item-value kamberdvach.konst@gmail.com
                .personal-info__item
                    .personal-info__item-name Телефон
                    .personal-info__item-value +7 (999) 666-66-66
                .personal-info__action
                    svg.personal-info__action-icon
                        use(href = "/assets/icons/icons.svg#personal-info-edit")
                    .personal-info__action-name Редактировать аккаунт
                .personal-info__action
                    svg.personal-info__action-icon
                        use(href = "/assets/icons/icons.svg#personal-info-delete")
                    .personal-info__action-name Удалить аккаунт
            .orders-history
                .orders-history__name История заказов
                .orders-history__empty
                    svg.orders-history__empty-icon
                        use(href = "/assets/icons/icons.svg#orders-history")
                p.orders-history__text Вы ещё ничего не заказали, но это легко исправить
                .orders-history__button-container 
                    button.orders-history__button Купить билеты
        .personal-cabinet-journey.mt-40
            .personal-cabinet-journey-tabs 
                .personal-cabinet-journey-tabs__tab_active Пригодится в поездке
                .personal-cabinet-journey-tabs__tab Акции и скидки
                .personal-cabinet-journey-tabs__tab Корпоративным клиентам
            .personal-cabinet-journey-pagination.mt-15-pg
                button.personal-cabinet-journey-pagination__button
                    svg.personal-cabinet-journey-pagination__icon
                        use(href = "/assets/icons/icons.svg#slider-arrow-left")
                button.personal-cabinet-journey-pagination__button
                    svg.personal-cabinet-journey-pagination__icon
                        use(href = "/assets/icons/icons.svg#slider-arrow-right")
            .personal-cabinet-journey-card-slider.mt-15
                .personal-cabinet-journey-card-slider-item
                    .personal-cabinet-journey-card-slider-item__photo
                        img(src="/assets/images/card-1.png", alt="card")
                    .personal-cabinet-journey-card-slider-item__headline Транспорт из аэропорта
                    .personal-cabinet-journey-card-slider-item__paragraph Вы можете заказать машину прямо из аэропорта. Цена известна заранее
                    .personal-cabinet-journey-card-slider-item__button Заказать
                .personal-cabinet-journey-card-slider-item
                    .personal-cabinet-journey-card-slider-item__photo
                        img(src="/assets/images/card-2.png", alt="card")
                    .personal-cabinet-journey-card-slider-item__headline Парковка у аэропорта
                    .personal-cabinet-journey-card-slider-item__paragraph Для удобства действует система долгосрочных и краткосрочных парковок автотранспорта.
                    .personal-cabinet-journey-card-slider-item__button Подробнее
                .personal-cabinet-journey-card-slider-item
                    .personal-cabinet-journey-card-slider-item__photo
                        img(src="/assets/images/card-3.png", alt="card")
                    .personal-cabinet-journey-card-slider-item__headline Гостиница «АэроОтель»
                    .personal-cabinet-journey-card-slider-item__paragraph Гостиница расположена напротив пассажирского павильона №3 в аэропорту "Архангельск".
                    .personal-cabinet-journey-card-slider-item__button Подробнее
                .personal-cabinet-journey-card-slider-item
                    .personal-cabinet-journey-card-slider-item__photo
                        img(src="/assets/images/card-4.png", alt="card")
                    .personal-cabinet-journey-card-slider-item__headline Бизнес-зал
                    .personal-cabinet-journey-card-slider-item__paragraph Для создания максимального комфорта, на втором этаже расположен Бизнес зал.
                    .personal-cabinet-journey-card-slider-item__button Подробнее

</template>
<script>

export default{

}
</script>