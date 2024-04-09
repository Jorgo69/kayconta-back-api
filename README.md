git clone repository file link

git clone https://github.com/Jorgo69/kayconta-back-api.git
cd on directory || cd kayconta-back-api
cmd composer install
copy .env.example .env
php artisan key:generate
php artisan migrate


To init
git init
git add files.extension 
git commit -m "commit"
git branch -M main
git remote add origin https://github.com/Jorgo69/kayconta-back-api.git link of repository
git push -u origin main





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

