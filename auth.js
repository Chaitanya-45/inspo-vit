const users = [
    { username: 'man', password: '123', role: 'admin' },
    { username: 'hi', password: '23', role: 'user' },
  ];
  
  let currentUser = null;
  
  function loginUser(username, password) {
    const user = users.find((u) => u.username === username && u.password === password);
  
    if (user) {
      currentUser = user;
      return true;
    }
  
    return false;
  }
  
  function getCurrentUser() {
    return currentUser;
  }
  
  function logoutUser() {
    currentUser = null;
  }
  