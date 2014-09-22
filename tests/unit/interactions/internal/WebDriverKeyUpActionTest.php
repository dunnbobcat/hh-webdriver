<?hh
// Copyright 2004-present Facebook. All Rights Reserved.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

class WebDriverKeyUpActionTest extends PHPUnit_Framework_TestCase {
  /**
   * @type WebDriverKeyUpAction
   */
  private $webDriverKeyUpAction;

  private $webDriverKeyboard;
  private $webDriverMouse;
  private $locationProvider;

  public function setUp() {
    $this->webDriverKeyboard = $this->getMock('WebDriverKeyboard');
    $this->webDriverMouse = $this->getMock('WebDriverMouse');
    $this->locationProvider = $this->getMock('WebDriverLocatable');
    $this->webDriverKeyUpAction = new WebDriverKeyUpAction(
      $this->webDriverKeyboard,
      $this->webDriverMouse,
      $this->locationProvider,
      'a'
    );
  }

  public function testPerformFocusesOnElementAndSendPressKeyCommand() {
    $coords = $this->getMockBuilder('WebDriverCoordinates')->disableOriginalConstructor()->getMock();
    $this->webDriverMouse->expects($this->once())->method('click')->with($coords);
    $this->locationProvider->expects($this->once())->method('getCoordinates')->will($this->returnValue($coords));
    $this->webDriverKeyboard->expects($this->once())->method('releaseKey')->with('a');
    $this->webDriverKeyUpAction->perform();
  }
}
