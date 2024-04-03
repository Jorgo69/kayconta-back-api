git clone repository file link






to create a user
ClientModel::create(array(
    'username' => 'first_user',
    'password' => Hash::make('123456'),
    'email'    => 'my@email.com'
));

User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);