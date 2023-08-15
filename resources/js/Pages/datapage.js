
return fetch('https://www.universal-tutorial.com/api/getaccesstoken', {
    method: 'GET',
    headers: {
        'Accept': 'application/json',
        'api-token': 'KTk9sEIO9Viw7ltuZHPKfGhsibYzd5OEwflxxE8QF6LX7jOZ287RdufbJ37sua7qfJI',
        'user-email': 'Santiagogbf2000@Gmail.com'
        }
        }).then(response => response.json())
        .then(data => {
          return data;
        })