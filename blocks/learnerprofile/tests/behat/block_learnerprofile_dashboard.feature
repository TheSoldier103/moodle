@block @block_learnerprofile
Feature: The learner profile block allows users to view their profile information in on the dashboard
  In order to enable the learner profile block on the dashboard
  As a user
  I can add the learner profile block to a the dashboard and view my information

  Scenario: View the learner profile block by a user on the dashboard
    Given the following "users" exist:
      | username | firstname | lastname | email                |
      | teacher1 | Teacher   | One      | teacher1@example.com |
    And I log in as "teacher1"
    And I press "Customise this page"
    When I add the "learner profile" block
    Then I should see "Teacher One" in the "learner profile" "block"
