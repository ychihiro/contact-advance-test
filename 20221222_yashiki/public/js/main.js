// 名前入力バリデーション
const firstnameText = document.getElementById('firstname');
const lastnameText = document.getElementById('lastname');
const fullname = document.getElementById('fullname');

const input_name = document.querySelectorAll('.input-name');
const name_wrapper = document.querySelector('.example-wrapper-name');
const error_name = document.createElement('p');
error_name.textContent = '名前を入力してください';
error_name.classList.add('error-msg');
const error_name_msg = document.querySelector('.error-name');

input_name.forEach(e => {
  e.addEventListener('blur', function () {
    if (error_name_msg) {
      error_name_msg.remove();
    }
    if (this.value == '') {
      this.classList.add('form-error');
      name_wrapper.before(error_name);
    }
  });
});

input_name.forEach(e => {
  e.addEventListener('input', function () {
    this.classList.remove('form-error');
    const firstname = firstnameText.value;
    const lastname = lastnameText.value;
    fullname.value = firstname + lastname;
    if (error_name_msg) {
      error_name_msg.remove();
    }
    if ( firstname !== '' && lastname !== '' ) {
    error_name.remove();
    }
  });
});

// メールアドレスバリデーション
const input_email = document.querySelector('.input-email');
const example_email = document.querySelector('.example-email');
const error_email = document.createElement('p');
error_email.textContent = 'メールアドレスを入力してください'; 
error_email.classList.add('error-msg');
const check_email = /.+@.+\..+/;
const error_email_msg = document.querySelector('.error-email');

input_email.addEventListener('blur', function () {
    if (error_email_msg) {
      error_email_msg.remove();
    }
    if (this.value == '') {
      this.classList.add('form-error');
      example_email.before(error_email);
    }
  });

input_email.addEventListener('input', function () {
  this.classList.remove('form-error');
  if (error_email_msg) {
      error_email_msg.remove();
    }
  if (this.value !== '' && check_email.test(input_email.value)) {
    error_email.remove();
  } else {
    example_email.before(error_email);
  }
});

// 郵便番号バリデーション
const input_postcode = document.querySelector('.input-postcode');
const example_postcode = document.querySelector('.example-postcode');
const error_postcode = document.createElement('p');
error_postcode.textContent = '郵便番号を入力してください';
error_postcode.classList.add('error-msg')
const error_postcode_length = document.createElement('p');
error_postcode_length.textContent = 'ハイフンありの8文字で入力してください';
error_postcode_length.classList.add('error-msg')
const pattern = /^[0-9]{3}-[0-9]{4}$/;
const error_postcode_search = document.createElement('p');
error_postcode_search.textContent = '郵便番号から住所が見つかりませんでした。';
error_postcode_search.classList.add('error-msg');
const error_postcode_msg = document.querySelector('.error-postcode');


input_postcode.addEventListener('blur', function () {
  if (error_postcode_msg) {
      error_postcode_msg.remove();
    }
    if (this.value == '') {
      this.classList.add('form-error');
      example_postcode.before(error_postcode);
      error_postcode_length.remove();
      error_postcode_search.remove();
    }
});

function toHalfWidth (str) {
  const hankaku_eisu = function(str) {
    if (!str) return '';
    return String.fromCharCode(str.charCodeAt(0) - 65536);
  };
  str = str.replace(/[A-Za-z0-9]/g, hankaku_eisu); 
  str = str.replace(/[−―‐ー]/g, '-'); 
  str = str.replace(/[ts ]/g, ''); 
  str = str.replace("-", "");
  return str;
}

input_postcode.addEventListener('input', function () {
  this.classList.remove('form-error');
  error_postcode.remove();
  example_postcode.before(error_postcode_length);

  const api = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode=';
  const url = api + toHalfWidth(this.value);

  if (error_postcode_msg) {
      error_postcode_msg.remove();
    }
  if (this.value.length === 8) {
    error_postcode_length.remove();
    fetchJsonp(url, {
      timeout: 10000,
    })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        if (data.results === null) {
          example_postcode.before(error_postcode_search);
          input_address.value = '';
        } else {
          input_address.value = data.results[0].address1 + data.results[0].address2 + data.results[0].address3;
          input_address.classList.remove('form-error');
          error_address.remove();
          if (error_address_msg) {
            error_address_msg.remove();
          }
        }
      })
  } else {
    error_postcode_search.remove();
    example_postcode.before(error_postcode_length);
  }
})

// 住所バリデーション
const input_address = document.querySelector('.input-address');
const example_address = document.querySelector('.example-address');
const error_address = document.createElement('p');
error_address.textContent = '住所を入力してください';
error_address.classList.add('error-msg');
const error_address_msg = document.querySelector('.error-address');

input_address.addEventListener('blur', function () {
    if (error_address_msg) {
      error_address_msg.remove();
    }
    if (this.value == '') {
      this.classList.add('form-error');
      example_address.before(error_address);
    }
});

input_address.addEventListener('input', function () {
  error_address.remove();
  if (error_address_msg) {
      error_address_msg.remove();
    }
  if (this.value !== '') {
    this.classList.remove('form-error');
    error_address.remove();
  }
});

// ご意見バリデーション
const input_opinion = document.querySelector('.input-opinion');
const confirm_btn = document.querySelector('.confirm-btn');
const error_opinion = document.createElement('p');
error_opinion.textContent = 'ご意見を入力してください';
error_opinion.classList.add('error-msg');
const error_opinion_length = document.createElement('p');
error_opinion_length.textContent = '120文字以内で入力してください';
error_opinion_length.classList.add('error-msg');
const error_opinion_msg = document.querySelector('.error-opinion');

input_opinion.addEventListener('blur', function () {
    if (error_opinion_msg) {
      error_opinion_msg.remove();
    }
    if (this.value == '') {
      this.classList.add('form-error');
      confirm_btn.before(error_opinion);
    }
});

input_opinion.addEventListener('input', function () {
  if (error_opinion_msg) {
      error_opinion_msg.remove();
    }
  if (this.value !== '') {
    this.classList.remove('form-error');
    error_opinion.remove();
  }
  if (this.value.length > 120) {
    confirm_btn.before(error_opinion_length);
  } else {
    error_opinion_length.remove();
  }
});
