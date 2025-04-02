{
  "name": "onesysteam/model-generator",
  "description": "A custom model generator for PHP projects using Composer",
  "autoload": {
    "psr-4": {
      "ModelFacade\\": "./"
    }
  },
  "scripts": {
    "post-install-cmd": [
      "ModelFacade\\Generator::generateModelFromInput"
    ],
    "post-update-cmd": [
      "ModelFacade\\Generator::generateModelFromInput"
    ]
  },
  "require": {}
}
