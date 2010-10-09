require 'rubygems'
require 'yaml'
require 'kaltura'

include Kaltura

# These values may be retrieved from your KMC account
login_email = "ben@openvideoalliance.org"
login_password = "qhhbAm31"
partner_id = 22646
subpartner_id = 2264600
admin_secret =  "f247245670f4d17dd33a87b8a75d8897"
user_secret = "a9a243ae37ab91e876e76c79c0e10de4"

config = Kaltura::KalturaConfiguration.new( partner_id )
client = Kaltura::KalturaClient.new( config )
session = client.session_service.start( user_secret )
client.ks = session

flavors = Kaltura::KalturaFlavorAssetService.new(client)



puts "\nflavors:"
puts flavors.get_by_entry_id('njbqgmfi1k').to_yaml


