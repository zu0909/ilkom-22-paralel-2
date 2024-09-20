require 'sinatra'

module Student
    class API < Sinatra::Base
        get '/' do
            'ini'
        end
        get '/student/:id' do
            "hi"
        end
    end
end
