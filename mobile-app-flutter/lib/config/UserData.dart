
class UserData {

  UserData({

    required this.name,
    required this.latitude,
    required this.longitude,
    required this.currentTime,
  });


  String currentTime;
  String name;
  String latitude;
  String longitude;

  Map<String, Object> toMap() {
    return {

      'currentTime': currentTime,
      'name': name,
      'latitude': latitude,
      'longitude': longitude,
      'currentTime': currentTime
    };
  }

  static UserData? fromMap(Map value) {
    if (value == null) {
      return null;
    }

    return UserData(
      name: value['name'],
      currentTime: value['currentTime'],
      latitude: value['latitude'],
      longitude: value['longitude'],
    );
  }

  @override
  String toString() {
    return ('{ currentTime: $currentTime ,name: $name, latitude: $latitude , longitude: $longitude }');
  }

}