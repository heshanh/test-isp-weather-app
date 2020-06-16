class CityDropDownComponent extends React.Component {
    constructor(props) {

        super(props);

        this.cityChange = this.cityChange.bind(this);
        this.cities = [
            {
                'label': 'Brisbane',
                'value': 'brisbane',
            },
            {
                'label': 'Hobart',
                'value': 'hobart',
            },
            {
                'label': 'Paris',
                'value': 'Paris',
            },
            {
                'label': 'BadCity',
                'value': 'BadCity',
            },
        ]

        this.state = {
            weatherResponse: [],
            disabled: false
        }

    }

    cityChange(event) {

        let selectedCity = event.target.value;

        this.setState({disabled: true})

        fetch("http://127.0.0.1:8000/api/weather-forecast?city=" + selectedCity)

            .then(res => res.json())

            .then(
                (result) => {
                    this.props.handler(result);

                    this.setState({disabled: false})
                }
            ).catch((error) => {

            alert('Invalid city');

            this.setState({disabled: false})
        });
    }

    render() {
        return <div>
            <select id="cityListDropDown" onChange={this.cityChange} disabled={this.state.disabled}
                    className="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Select A City</option>
                {this.cities.map(city => (
                    <option key={city.value} value={city.value}>
                        {city.label}
                    </option>
                ))}
            </select>
        </div>
    }
}

export default CityDropDownComponent;
