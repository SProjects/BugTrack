var frisby = require('frisby');

frisby.create('Get all users')
      .get('http://localhost/bugTrack/index.php/api/users/list')
      .expectStatus(200)
      .expectHeaderContains('content-type', 'application/json')
      .expectJSONLength(9)
      .toss();

frisby.create('Get user with ID 17')
    .get('http://localhost/bugTrack/index.php/api/users/show/id/17')
    .expectStatus(200)
    .expectHeaderContains('content-type', 'application/json')
    .expectJSONLength(5)
    .expectJSON({
        id: 17,
        name: 'Daniel Sebuuma',
        email: 'sedzsoft@gmail.com',
        username: 'admin',
        password: 'admin'
    })
    .toss();

//describe("test suite for user API endpoints", function(){
//    it("test should return all users", function(){
//        expect(true).toBe(true);
//    });
//});