@block @block_learnerprofile
Feature: The learner profile block allows users to view their profile information on the front page
  In order to enable the learner profile block on the frontpage
  As an admin
  I can add the learner profile block to the frontpage and view my information

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email                | idnumber |
      | teacher1 | Teacher   | One      | teacher1@example.com | T1       |
    And I log in as "admin"
    And I am on site homepage
    And I navigate to "Turn editing on" node in "Front page settings"
    And I add the "learner profile" block
    And I log out

  Scenario: Try to view the learner profile block as a guest
    Given I log in as "guest"
    When I am on site homepage
    Then I should not see "learner profile"

  Scenario: View the learner profile block by a learner profile
    Given I log in as "teacher1"
    When I am on site homepage
    Then I should see "Teacher One" in the "learner profile" "block"
