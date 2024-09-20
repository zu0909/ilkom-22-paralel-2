require 'sinatra'

module Lecturer
    class API < Sinatra::Base
        get '/' do
            'ini'
        end
        get '/lecturer/:id' do
            "hi"
        end
    end
end
