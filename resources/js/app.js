let appRoot = document.getElementById('app');

import CityDropDownComponent from './components/CityDropDownComponent';
import WeatherResponseComponent from "./components/WeatherResponseComponent";

class App extends React.Component {

    constructor(props) {

        super(props);

        this.responseHandler = this.responseHandler.bind(this)

        this.state = {
            weatherResponse: []
        }
    }

    responseHandler(result) {
        this.setState({
            weatherResponse: result
        })
    }

    render() {
        return <div>
            <CityDropDownComponent handler={this.responseHandler}/>
            <WeatherResponseComponent {...this.state} />
        </div>;
    }
}



ReactDOM.render(<App/>, appRoot);
