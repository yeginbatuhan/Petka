/*=========================================================================================
	File Name: ext-component-tour.js
	Description: extra component tour for webpage guide
	----------------------------------------------------------------------------------------
	Item Name: Frest HTML Admin Template
	Version: 1.0
	Author: Pixinvent
	Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/


$(function () {
  'use strict';

  var startBtn = $('#tour');
  function setupTour(tour) {
    var backBtnClass = 'btn btn-sm btn-outline-primary',
      nextBtnClass = 'btn btn-sm btn-primary btn-next';
    tour.addStep({
      title: 'Kısayollar',
      text: 'Menü kısayollarınızı buraya ekleyebilirsiniz',
      attachTo: { element: '.bookmark-wrapper', on: 'bottom' },
      buttons: [
        {
          action: tour.cancel,
          classes: backBtnClass,
          text: 'Geç'
        },
        {
          text: 'Sonraki',
          classes: nextBtnClass,
          action: tour.next
        }
      ]
    });
    tour.addStep({
      title: 'Dil Seçenekleri',
      text: 'Yönetim panelinizin dilini buradan seçerek değiştirebilirsiniz',
      attachTo: { element: '.dropdown-language', on: 'bottom' },
      buttons: [
        {
          action: tour.cancel,
          classes: backBtnClass,
          text: 'Geç'
        },
        {
          text: 'Sonraki',
          classes: nextBtnClass,
          action: tour.next
        }
      ]
    });
    tour.addStep({
      title: 'Bildirimler',
      text: 'Yönetim paneli otomatik bildirimleri bu alanda yer almaktadır.',
      attachTo: { element: '.dropdown-notification', on: 'bottom' },
      buttons: [
        {
          action: tour.cancel,
          classes: backBtnClass,
          text: 'Geç'
        },
        {
          text: 'Sonraki',
          classes: nextBtnClass,
          action: tour.next
        }
      ]
    });
    tour.addStep({
      title: 'Kullanıcı Menüsü',
      text: 'Kullanıcınıza ait işlemlerin yapıldığı ve çıkış işleminin yapıldığı alan',
      attachTo: { element: '.dropdown-user', on: 'bottom' },
      buttons: [
        {
          action: tour.cancel,
          classes: backBtnClass,
          text: 'Geç'
        },
        {
          text: 'Sonraki',
          classes: nextBtnClass,
          action: tour.next
        }
      ]
    });
    tour.addStep({
      title: 'Menü',
      text: 'Sitenizin içeriğini yöneteceğiniz alan',
      attachTo: { element: '.main-menu-content', on: 'right' },
      buttons: [
        {
          text: 'Geç',
          classes: backBtnClass,
          action: tour.cancel
        },
        {
          text: 'Geri',
          classes: backBtnClass,
          action: tour.back
        },
        // {
        //   text: 'Next',
        //   classes: nextBtnClass,
        //   action: tour.next
        // }

        {
          text: 'Bitir',
          classes: nextBtnClass,
          action: tour.cancel
        }
      ]
    });
    // tour.addStep({
    //   title: 'Footer',
    //   text: 'This is the footer',
    //   attachTo: { element: '.footer', on: 'top' },
    //   buttons: [
    //     {
    //       text: 'Back',
    //       classes: backBtnClass,
    //       action: tour.back
    //     },
    //     {
    //       text: 'Finish',
    //       classes: nextBtnClass,
    //       action: tour.cancel
    //     }
    //   ]
    // });

    return tour;
  }

  if (startBtn.length) {
    startBtn.on('click', function () {
      var tourVar = new Shepherd.Tour({
        defaultStepOptions: {
          classes: 'shadow-md',
          scrollTo: false,
          cancelIcon: {
            enabled: true
          }
        },
        useModalOverlay: true
      });

      setupTour(tourVar).start();
    });
  }
});
